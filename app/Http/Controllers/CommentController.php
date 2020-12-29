<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Comment;
use App\Thread;

class CommentController extends Controller
{

    public function addThreadComments(Request $request, Thread $thread) {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = auth()->user()->id;

        $thread->comments()->save($comment);

        return redirect()->back()->withMessage('Berhasil Menambahkan Komentar');
    }

    public function addReplyComments(Request $request, Coment $cooment) {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = auth()->user()->id;

        $comment->comments()->save($comment);

        return redirect()->back()->withMessage('Berhasil Menambahkan Reply');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->user()->id) {
            abort(401);
        }

        $this->validate($request, [
            'body' => 'required',
        ]);

        $comment->update($request->all());

        return redirect()->back()->withMessage('Berhasil Mengedit Komentar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->user()->id) {
            abort(401);
        }

        $comment->delete();

        return redirect()->back()->withMessage('Berhasil Menghapus Komentar');
    }
}