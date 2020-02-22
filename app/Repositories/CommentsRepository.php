<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repositories;


use App\Models\Comment;
use App\Repositories\Interfaces\CommentsRepositoryInterface;

/**
 * Class CommentsRepository
 *
 * @package App\Repositories
 */
class CommentsRepository implements CommentsRepositoryInterface
{
    /**
     * @param $id
     *
     * @return mixed|void
     */
    public function getComments($id)
    {
        $result = Comment::where('anime_id', '=', $id)
            ->with('getUser')
            ->get();

        $result->transform(function ($comment) use ($result) {
            // Добавляем к каждому комментарию дочерние комментарии.
            $comment->children = $result->where('parent_comment_id', $comment->id);

            return $comment;
        });

// Удаляем из коллекции комментарии у которых есть родители.
        $result = $result->reject(function ($comment) {

            return $comment->parent_comment_id !== 0;
        });

        return $result;
    }

    public function countComments($id)
    {
       return Comment::where('anime_id', '=', $id)
           ->with('getAnime')
           ->count();
    }

    /**
     * @param $id
     *
     * @return mixed|void
     */
    public function setComments($id)
    {
        // TODO: Implement setComments() method.
    }
}
