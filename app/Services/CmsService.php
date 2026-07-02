<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Section;
use App\Models\SectionItem;
use App\Models\Setting;
use Illuminate\Support\Collection;

class CmsService
{
    /**
     * Retrieve a page by slug with its active sections and items.
     */
    public function getPageWithSections(string $slug): Page
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        
        $page->setRelation('sections', $page->sections()
            ->where('is_active', true)
            ->with(['items' => function ($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->orderBy('order')
            ->get()
        );

        return $page;
    }

    /**
     * Retrieve all key-value settings.
     */
    public function getAllSettings(): Collection
    {
        return Setting::all()->pluck('value', 'key');
    }

    /**
     * Retrieve settings by group.
     */
    public function getSettingsByGroup(string $group): Collection
    {
        return Setting::where('group', $group)->pluck('value', 'key');
    }

    /**
     * Update settings by key-value pairs.
     */
    public function updateSettings(array $settings): void
    {
        foreach ($settings as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }
    }

    /**
     * Update a section's contents.
     */
    public function updateSection(Section $section, array $data): Section
    {
        $section->update($data);
        return $section;
    }

    /**
     * Add a repeatable item to a section.
     */
    public function storeSectionItem(Section $section, array $data): SectionItem
    {
        return $section->items()->create($data);
    }

    /**
     * Update a section item.
     */
    public function updateSectionItem(SectionItem $item, array $data): SectionItem
    {
        $item->update($data);
        return $item;
    }
}
