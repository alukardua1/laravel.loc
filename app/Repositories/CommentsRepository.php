<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Comment;
use App\Repositories\Interfaces\CommentsRepositoryInterface;
use Throwable;
use Illuminate\Http\Request;

/**
 * Class CommentsRepository
 *
 * @package App\Repositories
 */
class CommentsRepository implements CommentsRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return mixed|void
     */
    public function getComments($id)
    {
        $result = Comment::where('anime_id', '=', $id)
            ->with('getUser')
            ->get();

        $result->transform(
            function ($comment) use ($result) {
                // Добавляем к каждому комментарию дочерние комментарии.
                $comment->children = $result->where('parent_comment_id', $comment->id);

                return $comment;
            }
        );

        // Удаляем из коллекции комментарии у которых есть родители.
        $result = $result->reject(
            function ($comment) {
                return $comment->parent_comment_id !== 0;
            }
        );

        return $result;
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function countComments($id)
    {
        return Comment::where('anime_id', '=', $id)->count();
    }

    /**
     * @param \Illuminate\Http\Request   $request
     * @param                            $id
     *
     * @return mixed|void
     */
    public function setComments(Request $request, $id = null)
    {
        return Comment::create($request->all());
    }

    /**
     * @param int $id
     *
     * @return bool|mixed|null
     * @throws Throwable
     */
    public function delComments($id)
    {
        /** @var \App\Models\Comment $deleteComment */
        $deleteComment = Comment::where('parent_comment_id', $id)->get();

        /** @var \App\Models\Comment $comm */
        foreach ($deleteComment as $comm) {
            $comm->delete();
        }

        $deleteComment = Comment::where('id', $id)->first();

        return $deleteComment->delete();
    }
}
