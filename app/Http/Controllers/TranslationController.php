<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Translation;
use App\Models\TranslationTag;

class TranslationController extends Controller
{
    /**
     * Create a new translation.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'locale' => 'required|string|max:10',
            'key' => 'required|string',
            'content' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ]);

        // Create or update translation.
        $translation = Translation::updateOrCreate(
            ['locale' => $validated['locale'], 'key' => $validated['key']],
            ['content' => $validated['content']]
        );

        // Handle tags.
        if (!empty($validated['tags'])) {
            $this->syncTags($translation, $validated['tags']);
        }

        return response()->json(['message' => 'Translation created/updated successfully'], 201);
    }

    /**
     * Update an existing translation.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ]);

        $translation = Translation::findOrFail($id);

        // Update content.
        $translation->update(['content' => $validated['content']]);

        // Update tags.
        if (isset($validated['tags'])) {
            $this->syncTags($translation, $validated['tags']);
        }

        return response()->json(['message' => 'Translation updated successfully']);
    }

    /**
     * View a translation by ID.
     */
    public function view($id)
    {
        $translation = Translation::with('tags')->findOrFail($id);

        return response()->json($translation);
    }

    /**
     * Search translations by tags, keys, or content.
     */
    public function search(Request $request)
    {
        $query = Translation::query();

        if ($request->filled('tags')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->whereIn('tag', $request->tags);
            });
        }

        if ($request->filled('key')) {
            $query->where('key', 'like', "%{$request->key}%");
        }

        if ($request->filled('content')) {
            $query->where('content', 'like', "%{$request->content}%");
        }

        return response()->json($query->with('tags')->paginate(10));
    }

    /**
     * Export translations for a given locale.
     */
    public function export(Request $request)
    {
        $locale = $request->query('locale', 'en');
        $translations = [];

        Translation::where('locale', $locale)
            ->chunk(1000, function ($chunk) use (&$translations) {
                foreach ($chunk as $translation) {
                    $translations[$translation->key] = $translation->content;
                }
            });

        return response()->json($translations);
    }

    /**
     * Sync tags for a translation.
     */
    private function syncTags(Translation $translation, array $tags)
    {
        $tagIds = [];
        foreach ($tags as $tag) {
            $tagIds[] = TranslationTag::firstOrCreate(['translation_id' => $translation->id, 'tag' => $tag])->id;
        }

        // Optionally remove old tags not in the current list.
        TranslationTag::where('translation_id', $translation->id)->whereNotIn('id', $tagIds)->delete();
    }
}
