<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    /**
     * Display a listing of messages.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Messages/Index', [
            'messages' => ContactMessage::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Toggle read/unread state of a message.
     */
    public function toggleRead(ContactMessage $message): RedirectResponse
    {
        $message->update([
            'is_read' => ! $message->is_read,
        ]);

        return back()->with('success', 'Message status updated.');
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}
