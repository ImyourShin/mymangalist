@extends('layouts.frontend')

@section('title', $manga->title)

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
    <style>
        :root {
            --primary-orange: #ff6b47;
            --primary-orange-dark: #e55a2b;
            --primary-orange-light: #ff8e53;
            --dark-bg: #0f0f0f;
            --dark-bg-secondary: #1a1a1a;
            --dark-bg-tertiary: #242424;
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.85);
            --text-muted: rgba(255, 255, 255, 0.6);
            --border-color: rgba(255, 255, 255, 0.1);
            --hover-bg: rgba(255, 255, 255, 0.05);
        }

        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-bg-secondary) 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-primary);
        }

        /* Glass Card Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 32px;
            margin-bottom: 32px;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            border-color: rgba(255, 107, 71, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        /* Section Headers */
        .section-header {
            font-weight: 800;
            font-size: 1.75rem;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 40px 0 24px;
        }

        .section-header i {
            color: var(--primary-orange);
            font-size: 1.5rem;
        }

        /* Cover Image */
        .cover-container {
            position: relative;
        }

        .cover-img {
            width: 100%;
            max-width: 400px;
            height: 550px;
            object-fit: cover;
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-color);
        }

        .no-image-placeholder {
            width: 100%;
            max-width: 400px;
            height: 550px;
            background: linear-gradient(135deg, var(--dark-bg-secondary), var(--dark-bg-tertiary));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
            border: 1px solid var(--border-color);
        }

        .no-image-placeholder i {
            font-size: 4rem;
            color: var(--text-muted);
            opacity: 0.5;
        }

        /* Buttons */
        .btn-primary-orange {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-orange:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 71, 0.4);
            color: white;
        }

        .btn-danger-modern {
            background: linear-gradient(135deg, #e53935, #ef5350);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-danger-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(229, 57, 53, 0.4);
            color: white;
        }

        /* Title Bar */
        .title-bar {
            background: linear-gradient(135deg, rgba(255, 107, 71, 0.2), rgba(255, 107, 71, 0.05));
            border-left: 4px solid var(--primary-orange);
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        /* Info Rows */
        .info-label {
            color: var(--text-muted);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-width: 120px;
        }

        .info-label i {
            color: var(--primary-orange);
            font-size: 0.9rem;
        }

        .info-value {
            color: var(--text-primary);
            font-weight: 600;
        }

        /* Genre Tags */
        .genre-tag {
            display: inline-block;
            background: rgba(255, 107, 71, 0.15);
            border: 1px solid rgba(255, 107, 71, 0.3);
            border-radius: 8px;
            padding: 8px 16px;
            margin: 4px 8px 4px 0;
            color: var(--primary-orange-light);
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .genre-tag:hover {
            background: rgba(255, 107, 71, 0.25);
            transform: translateY(-2px);
        }

        /* Synopsis */
        .synopsis-box {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border-color);
            line-height: 1.8;
            color: var(--text-secondary);
        }

        /* Review Form */
        .review-form-container {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border-color);
        }

        .star-rating {
            font-size: 2rem;
            cursor: pointer;
            user-select: none;
        }

        .star {
            color: #555;
            transition: all 0.2s ease;
        }

        .star:not(.inactive) {
            color: #ffd700;
            text-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
        }

        .star:hover {
            transform: scale(1.1);
        }

        textarea.form-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            color: var(--text-primary);
            width: 100%;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        textarea.form-input:focus {
            outline: none;
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 71, 0.1);
            background: rgba(255, 255, 255, 0.08);
        }

        textarea.form-input::placeholder {
            color: var(--text-muted);
        }

        /* Review Cards */
        .review-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .review-card:hover {
            border-color: rgba(255, 107, 71, 0.3);
            transform: translateY(-2px);
        }

        .review-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(255, 107, 71, 0.3);
        }

        .review-username {
            font-weight: 700;
            color: var(--text-primary);
            font-size: 1.1rem;
        }

        .review-stars .star {
            font-size: 1rem;
            color: #ffd700;
        }

        .review-stars .inactive {
            color: #555;
        }

        .review-time {
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .review-comment {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-top: 12px;
        }

        .review-actions {
            display: flex;
            gap: 8px;
            margin-top: 16px;
        }

        .btn-edit,
        .btn-delete {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-edit {
            background: rgba(255, 179, 0, 0.2);
            color: #ffb300;
            border: 1px solid rgba(255, 179, 0, 0.3);
        }

        .btn-edit:hover {
            background: rgba(255, 179, 0, 0.3);
            transform: translateY(-2px);
        }

        .btn-delete {
            background: rgba(229, 57, 53, 0.2);
            color: #e53935;
            border: 1px solid rgba(229, 57, 53, 0.3);
        }

        .btn-delete:hover {
            background: rgba(229, 57, 53, 0.3);
            transform: translateY(-2px);
        }

        .btn-secondary-modern {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary-modern:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary-orange);
            color: var(--text-primary);
        }

        /* Info Message */
        .info-message {
            background: rgba(33, 150, 243, 0.1);
            border: 1px solid rgba(33, 150, 243, 0.3);
            border-radius: 12px;
            padding: 16px 20px;
            color: #64b5f6;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-message i {
            font-size: 1.2rem;
        }

        /* Login Prompt */
        .login-prompt {
            text-align: center;
            padding: 40px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .glass-card {
                padding: 20px;
            }

            .cover-img,
            .no-image-placeholder {
                max-width: 100%;
                height: 400px;
            }

            .title-bar {
                font-size: 1.5rem;
            }

            .section-header {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="container mt-4">
        <!-- Main Content Card -->
        <div class="glass-card">
            <div class="row g-4">
                <!-- Cover Column -->
                <div class="col-md-4">
                    <div class="cover-container text-center">
                        @if ($manga->cover_img)
                            <img src="{{ asset('storage/' . $manga->cover_img) }}" class="cover-img"
                                alt="{{ $manga->title }}">
                        @else
                            <div class="no-image-placeholder">
                                <i class="bi bi-image"></i>
                                <span style="color: var(--text-muted);">No Image Available</span>
                            </div>
                        @endif
                    </div>

                    <!-- Favorite Button -->
                    @auth
                        <button id="favorite-btn" data-manga="{{ $manga->manga_id }}"
                            class="mt-4 w-100 {{ $isFavorite ? 'btn-danger-modern' : 'btn-primary-orange' }}">
                            {{ $isFavorite ? '❌ Remove from Favorites' : '⭐ Add to Favorites' }}
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary-orange mt-4 w-100"
                            onclick="alert('Please login to add favorites.')">
                            <i class="fas fa-sign-in-alt"></i> Login to Add Favorite
                        </a>
                    @endauth
                </div>

                <!-- Info Column -->
                <div class="col-md-8">
                    <h1 class="title-bar">{{ $manga->title }}</h1>

                    <div class="mb-3">
                        <p class="mb-2">
                            <span class="info-label"><i class="fas fa-pen"></i> Author:</span>
                            <span class="info-value">{{ $manga->author ?? 'Unknown' }}</span>
                        </p>
                        <p class="mb-2">
                            <span class="info-label"><i class="fas fa-building"></i> Publisher:</span>
                            <span class="info-value">{{ $manga->publisher ?? 'Unknown' }}</span>
                        </p>
                        <p class="mb-2">
                            <span class="info-label"><i class="fas fa-info-circle"></i> Status:</span>
                            <span class="info-value">{{ $manga->status }}</span>
                        </p>
                        <p class="mb-3">
                            <span class="info-label"><i class="fas fa-calendar"></i> Release Year:</span>
                            <span class="info-value">{{ $manga->release_year }}</span>
                        </p>

                        <div class="mb-4">
                            <span class="info-label"><i class="fas fa-tags"></i> Genres:</span><br>
                            @forelse($manga->genres as $g)
                                <span class="genre-tag">{{ $g->name }}</span>
                            @empty
                                <span class="text-muted">No genres</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="section-header">
                        <i class="bi bi-book"></i>
                        Synopsis
                    </div>
                    <div class="synopsis-box">
                        {{ $manga->synopsis ?? 'No synopsis available.' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Section -->
        @auth
            @if (!$userReview)
                <!-- Write Review Form -->
                <div class="section-header">
                    <i class="bi bi-pencil-square"></i>
                    Write a Review
                </div>
                <div class="glass-card">
                    <div class="review-form-container">
                        <form action="{{ route('frontend.reviews.store', $manga->manga_id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-bold">Rating</label>
                                <div class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star inactive" data-value="{{ $i }}">★</span>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating-input" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Comment</label>
                                <textarea name="comment" class="form-input" rows="4" placeholder="Share your thoughts about this manga..."></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn-primary-orange">
                                    <i class="fas fa-paper-plane"></i> Submit Review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <!-- Already Reviewed Message -->
                <div class="section-header">
                    <i class="bi bi-check-circle"></i>
                    Your Review
                </div>
                <div class="glass-card">
                    <div class="info-message">
                        <i class="fas fa-info-circle"></i>
                        <span>You have already reviewed this manga. You can edit or delete your review below.</span>
                    </div>
                </div>
            @endif
        @else
            <!-- Login Prompt -->
            <div class="section-header">
                <i class="bi bi-pencil-square"></i>
                Write a Review
            </div>
            <div class="glass-card">
                <div class="login-prompt">
                    <i class="fas fa-lock" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 16px;"></i>
                    <p class="text-muted mb-3">Please login to write a review</p>
                    <a href="{{ route('login') }}" class="btn-primary-orange">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </div>
            </div>
        @endauth

        <!-- Reviews List -->
        <div class="section-header">
            <i class="bi bi-chat-dots"></i>
            Reviews ({{ $manga->reviews->count() }})
        </div>

        @forelse ($manga->reviews as $review)
            <div class="review-card" id="review-{{ $review->review_id }}">
                <!-- Normal Review Display -->
                <div class="review-content">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div class="review-avatar">
                            {{ strtoupper(substr($review->user->username ?? 'A', 0, 1)) }}
                        </div>
                        <div class="flex-grow-1">
                            <div class="review-username">{{ $review->user->username ?? 'Anonymous' }}</div>
                            <div class="review-stars mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $review->rating ? '' : 'inactive' }}">★</span>
                                @endfor
                            </div>
                            <div class="review-time">
                                <i class="far fa-clock"></i>
                                {{ $review->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <p class="review-comment mb-0">{{ $review->comment }}</p>

                    @auth
                        @if (auth()->id() === $review->user_id || auth()->user()->role === 'admin')
                            <div class="review-actions">
                                @can('update', $review)
                                    <button type="button" class="btn btn-edit"
                                        onclick="toggleEditForm('{{ $review->review_id }}')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                @endcan

                                @can('delete', $review)
                                    <form action="{{ route('frontend.reviews.remove', $review->review_id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this review?');"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        @endif
                    @endauth
                </div>

                <!-- Edit Form -->
                @can('update', $review)
                    <div class="review-edit-form mt-4" id="edit-form-{{ $review->review_id }}" style="display: none;">
                        <form action="{{ route('frontend.reviews.update', $review->review_id) }}" method="POST"
                            class="edit-review-form" data-review-id="{{ $review->review_id }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-bold">Rating</label>
                                <div class="star-rating edit-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star {{ $i <= $review->rating ? '' : 'inactive' }}"
                                            data-value="{{ $i }}">★</span>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" value="{{ $review->rating }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Comment</label>
                                <textarea name="comment" class="form-input" rows="3">{{ $review->comment }}</textarea>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn-secondary-modern"
                                    onclick="toggleEditForm('{{ $review->review_id }}')">
                                    Cancel
                                </button>
                                <button type="submit" class="btn-primary-orange ms-2">
                                    <i class="fas fa-check"></i> Update Review
                                </button>
                            </div>
                        </form>
                    </div>
                @endcan
            </div>
        @empty
            <div class="glass-card">
                <div class="text-center py-5">
                    <i class="far fa-comments" style="font-size: 4rem; color: var(--text-muted); opacity: 0.5;"></i>
                    <p class="text-muted mt-3 mb-0">No reviews yet. Be the first to review!</p>
                </div>
            </div>
        @endforelse
    </div>

    @push('scripts')
        <script>
            // Star rating for main form
            document.querySelectorAll('.star-rating .star').forEach(star => {
                star.addEventListener('click', function() {
                    const container = this.closest('.star-rating');
                    const form = this.closest('form');
                    const ratingInput = form.querySelector('#rating-input') || form.querySelector(
                        'input[name="rating"]');
                    const val = this.dataset.value;

                    if (ratingInput) {
                        ratingInput.value = val;
                    }

                    container.querySelectorAll('.star').forEach(s => {
                        s.classList.toggle('inactive', s.dataset.value > val);
                    });
                });
            });

            // Favorite button
            document.addEventListener("DOMContentLoaded", () => {
                const btn = document.getElementById("favorite-btn");
                if (btn) {
                    btn.addEventListener("click", () => {
                        let mangaId = btn.dataset.manga;
                        fetch(`/favorites/toggle/${mangaId}`, {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Accept": "application/json",
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.status === "added") {
                                    btn.innerHTML = '❌ Remove from Favorites';
                                    btn.classList.remove("btn-primary-orange");
                                    btn.classList.add("btn-danger-modern");
                                } else if (data.status === "removed") {
                                    btn.innerHTML = '⭐ Add to Favorites';
                                    btn.classList.remove("btn-danger-modern");
                                    btn.classList.add("btn-primary-orange");
                                }
                            });
                    });
                }
            });

            // Toggle edit form
            function toggleEditForm(reviewId) {
                const reviewContent = document.querySelector(`#review-${reviewId} .review-content`);
                const editForm = document.querySelector(`#edit-form-${reviewId}`);

                if (editForm.style.display === 'none') {
                    reviewContent.style.display = 'none';
                    editForm.style.display = 'block';
                } else {
                    reviewContent.style.display = 'block';
                    editForm.style.display = 'none';
                }
            }

            // Handle form submission with AJAX
            document.querySelectorAll('.edit-review-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const reviewId = this.dataset.reviewId;
                    const formData = new FormData(this);

                    fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const reviewCard = document.querySelector(`#review-${reviewId}`);
                                const stars = reviewCard.querySelector('.review-stars');
                                const comment = reviewCard.querySelector('.review-comment');

                                stars.innerHTML = Array(5).fill(0).map((_, i) =>
                                    `<span class="star ${i < data.review.rating ? '' : 'inactive'}">★</span>`
                                ).join('');

                                comment.textContent = data.review.comment;
                                toggleEditForm(reviewId);
                            }
                        });
                });
            });
        </script>
    @endpush
@endsection
