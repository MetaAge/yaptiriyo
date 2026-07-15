<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\ContentReport;
use App\Models\UserBlock;
use Illuminate\Http\Request;

/**
 * User safety: report content/users and block/unblock abusive users.
 * Required for App Store Guideline 1.2 (user-generated content).
 */
class ModerationController extends Controller
{
    /** Submit a report about a user or a piece of content. */
    public function report(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:100',
            'note' => 'nullable|string|max:1000',
            'reported_user_id' => 'nullable|integer',
            'reportable_type' => 'nullable|string|max:50',
            'reportable_id' => 'nullable|integer',
        ]);

        $userId = (auth('sanctum')->id() ?? auth()->id());

        $report = ContentReport::create([
            'reporter_id' => $userId,
            'reported_user_id' => $request->reported_user_id,
            'reportable_type' => $request->reportable_type,
            'reportable_id' => $request->reportable_id,
            'reason' => $request->reason,
            'note' => $request->note,
            'status' => 'pending',
        ]);

        // Surface to admins so reports are reviewed in a timely manner.
        try {
            AdminNotification::create([
                'identity' => $report->id,
                'user_id' => $userId,
                'type' => 'Report',
                'message' => 'Yeni içerik/kullanıcı şikâyeti alındı.',
            ]);
        } catch (\Throwable $e) {}

        return response()->json([
            'status' => 'success',
            'msg' => __('Şikâyetiniz alındı. En kısa sürede incelenecektir.'),
        ]);
    }

    /** Block a user. */
    public function block(Request $request)
    {
        $request->validate(['user_id' => 'required|integer']);

        $me = (auth('sanctum')->id() ?? auth()->id());
        if ((int) $request->user_id === (int) $me) {
            return response()->json(['msg' => __('Kendinizi engelleyemezsiniz.')], 422);
        }

        UserBlock::firstOrCreate([
            'blocker_id' => $me,
            'blocked_id' => $request->user_id,
        ]);

        return response()->json([
            'status' => 'success',
            'msg' => __('Kullanıcı engellendi.'),
        ]);
    }

    /** Remove a block. */
    public function unblock(Request $request)
    {
        $request->validate(['user_id' => 'required|integer']);

        UserBlock::where('blocker_id', (auth('sanctum')->id() ?? auth()->id()))
            ->where('blocked_id', $request->user_id)
            ->delete();

        return response()->json([
            'status' => 'success',
            'msg' => __('Engel kaldırıldı.'),
        ]);
    }

    /** List the ids the current user has blocked. */
    public function blockedList()
    {
        $ids = UserBlock::where('blocker_id', (auth('sanctum')->id() ?? auth()->id()))
            ->pluck('blocked_id');

        return response()->json(['blocked_user_ids' => $ids]);
    }
}
