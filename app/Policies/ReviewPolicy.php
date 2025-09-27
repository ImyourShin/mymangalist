<?php

namespace App\Policies;

use App\Models\UserModel;
use App\Models\ReviewModel;

class ReviewPolicy
{
    /**
     * Determine whether the user can delete the review.
     */
    public function delete(UserModel $user, ReviewModel $review): bool
    {
        // Admin ลบได้ทุก review
        // User ธรรมดาลบได้เฉพาะของตัวเอง
        return $user->role === 'admin' || $user->user_id === $review->user_id;
    }

    /**
     * Determine whether the user can update the review.
     */
    public function update(UserModel $user, ReviewModel $review): bool
    {
        // Admin แก้ได้ทุก review
        // User ธรรมดาแก้ได้เฉพาะของตัวเอง
        return $user->role === 'admin' || $user->user_id === $review->user_id;
    }
}
