<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'label',
        'filename',
        'original_name',
        'extension',
        'file_size',
        'is_public',
        'sort_order',
        'google_drive_url',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'file_size' => 'integer',
    ];

    // ── Private helpers ────────────────────────────────────────────────

    /** Extract the file ID from any Google Drive sharing URL. */
    private function driveFileId(?string $url): ?string
    {
        if (!$url) return null;
        if (preg_match('|/d/([a-zA-Z0-9_-]+)|', $url, $m)) return $m[1];
        return null;
    }

    // ── Public accessors ───────────────────────────────────────────────

    /**
     * URL used inside the modal <iframe> — Google Drive's /preview endpoint
     * gives a clean embedded viewer with no ads or sign-in walls.
     */
    public function getEmbedUrlAttribute(): string
    {
        $id = $this->driveFileId($this->google_drive_url);
        if ($id) {
            return "https://drive.google.com/file/d/{$id}/preview";
        }
        return route('cv.view', $this->id);
    }

    /**
     * URL for "Open in New Tab" — the standard /view URL works best for
     * full-screen viewing with Google Drive's own toolbar.
     */
    public function getViewUrlAttribute(): string
    {
        $id = $this->driveFileId($this->google_drive_url);
        if ($id) {
            return "https://drive.google.com/file/d/{$id}/view";
        }
        return route('cv.view', $this->id);
    }

    /**
     * URL for the Download button — Google's direct export endpoint forces
     * a browser download instead of the viewer.
     */
    public function getDownloadUrlAttribute(): string
    {
        $id = $this->driveFileId($this->google_drive_url);
        if ($id) {
            return "https://drive.google.com/uc?export=download&id={$id}";
        }
        return route('cv.download.multi', $this->id);
    }
}
