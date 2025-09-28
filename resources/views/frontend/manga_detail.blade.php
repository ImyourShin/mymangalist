@extends('layouts.frontend')

@section('title', $manga->title)

@section('content')
<style>
    :root {
    --bg-0: #121212;
    --bg-1: #161616;
    --bg-2: #1a1a1a;
    --glass: rgba(255,255,255,.04);
    --white: #ffffff;
    --muted: #a6a6a6;
    --accent: #FF4C00;
    --shadow: 0 10px 30px rgba(0,0,0,.45);
    --radius: 16px;
    }
    body {
        background: #121212;
        font-family: 'Poppins', 'Inter', sans-serif;
        color: #f1f1f1;
    }

    .text-author {
    color: var(--muted) !important;
    }

    /* Glass card */
    .glass-card {
        background: rgba(30, 30, 30, 0.7);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.5);
        margin-bottom: 24px;
    }

    /* Section headers */
    .section-header {
        font-weight: bold;
        padding: 10px 16px;
        border-left: 5px solid #FF4C00;
        background: rgba(26, 26, 26, 0.9);
        backdrop-filter: blur(6px);
        border-radius: 8px;
        margin: 24px 0 12px 0;
        font-size: 1.05rem;
    }

    /* Buttons */
    .btn-orange {
        background: #FF4C00;
        border: none;
        border-radius: 30px;
        padding: 10px 22px;
        color: white;
        font-weight: 600;
        transition: all .3s ease;
    }
    .btn-orange:hover,
    .btn-warning:hover {
        box-shadow: 0 0 12px #FF4C00;
        transform: scale(1.05);
    }
    .btn-warning {
        background: #FF4C00;
        border: none;
        color: #fff;
        border-radius: 30px !important;
        font-weight: 600;
    }
    .btn-danger {
        border-radius: 30px !important;
        font-weight: 600;
    }

    .cover-img {
    width: 100%;
    max-width: 450px;   /* ความกว้างสูงสุด */
    height: 550px;      /* บังคับสูงแนวตั้ง */
    object-fit: cover;  /* ครอบตัดไม่บิด */
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
}

    /* Tags */
    .tag-pill {
        display: inline-block;
        background: #FF4C00;
        color: white;
        border-radius: 20px;
        padding: 4px 12px;
        margin: 2px 6px 0 0;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* Stars */
    .star {
        font-size: 1.2rem;
        color: #FF4C00;
        cursor: pointer;
    }
    .star.inactive { color: #555; }

    /* Inputs */
    textarea, input[type=number] {
        background: #1e1e1e;
        border: none;
        color: #f1f1f1;
        border-radius: 12px;
        padding: 10px;
        width: 100%;
        border-color: var(--white);
    }
    textarea::placeholder {
        color: #888;
    }

    .review-card {
    background: #1f1f1f;
    border-radius: 10px;
    padding: 16px;
    margin-bottom: 16px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.4);
}

.review-header {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 8px;
}

.review-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #FF4C00;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: white;
    font-size: 0.9rem;
    flex-shrink: 0;
    box-shadow: 0 2px 6px rgba(0,0,0,0.4);
}

.review-username {
    font-weight: 600;
    color: #fff;
    font-size: 1rem;
}

.review-stars {
    margin: 2px 0;
}
.review-stars .star {
    font-size: 1rem;
    color: #FF4C00;
}
.review-stars .inactive {
    color: #555;
}

.review-time {
    font-size: 0.8rem;
    display: block;
    margin-top: 2px;
}

.review-comment {
    margin-left: 54px; /* align with text after avatar */
    line-height: 1.5;
    color: #f1f1f1;
}

.review-actions {
    margin-left: 54px;
    margin-top: 8px;
    display: flex;
    gap: 8px;
}

.btn-edit {
    background: #ffb300;
    color: #fff;
    border-radius: 20px;
    padding: 4px 12px;
    font-weight: 600;
    transition: 0.2s;
}
.btn-edit:hover { background: #ffca28; }

.btn-delete {
    background: #e53935;
    color: #fff;
    border-radius: 20px;
    padding: 4px 12px;
    font-weight: 600;
    transition: 0.2s;
}
.btn-delete:hover { background: #ef5350; }

.title-bar {
    background: #2b2b2b;
    padding: 8px 12px;
    
    color: #fff;
    text-transform: uppercase;
}

</style>

<div class="glass-card mt-4">
    <div class="row g-4">
        <!-- Cover -->
        <div class="col-md-4 text-center">
            @if ($manga->cover_img)
                <img src="{{ asset('storage/' . $manga->cover_img) }}" 
                     class="cover-img" style=" object-fit: cover;">
            @else
                <div class="bg-secondary text-center p-5 rounded">No Image</div>
            @endif

            {{-- Favorite Button --}}
            @auth
                <button id="favorite-btn" data-manga="{{ $manga->manga_id }}" 
                        class="mt-3 float-start {{ $isFavorite ? 'btn btn-danger' : 'btn btn-warning' }}">
                    {{ $isFavorite ? '❌ Remove from Favorite' : '⭐ Add to Favorite' }}
                </button>
            @else
                <a href="{{ route('login') }}" 
                onclick="alert('Please login before adding to favorites.')" 
                class="btn btn-warning mt-3 float-start">⭐ Add to Favorite</a>
            @endauth
        </div>

        <!-- Info -->
        <div class="col-md-8">
            <h2 class="fw-bold title-bar">{{ $manga->title }}</h2>
            <p><span class="text-author">Author :</span> <strong>{{ $manga->author ?? '-' }}</strong></p>
            <p><span class="text-author">Publisher :</span> <strong>{{ $manga->publisher ?? '-' }}</strong></p>
            <p><span class="text-author">Status :</span> <strong>{{ $manga->status }}</strong></p>
            <p><span class="text-author">Release Year :</span> <strong>{{ $manga->release_year }}</strong></p>
            <p>
                @if($manga->genre)
                    @foreach(explode(',', $manga->genre) as $g)
                        <span class="tag-pill">{{ trim($g) }}</span>
                    @endforeach
                @else
                    -
                @endif
            </p>
            
            
            
            <h2 class="fw-bold title-bar">SYNOPSIS</h2>
            <p>
                Ten years ago, "the Gate" appeared and connected the real world with the realm of magic and monsters. 
                To combat these vile beasts, ordinary people received superhuman powers and became known as "Hunters." 
                Twenty-year-old Sung Jin-Woo is one such Hunter, but he is known as the "World's Weakest," owing to his pathetic power compared to even a measly E-Rank. 
                Still, he hunts monsters tirelessly in low-rank Gates to pay for his mother's medical bills.
            </p><br>
            <p>
                However, this miserable lifestyle changes when Jin-Woo—believing himself to be the only one left to die in a mission gone 
                terribly wrong—awakens in a hospital three days later to find a mysterious screen floating in front of him. This "Quest Log" demands that Jin-Woo 
                completes an unrealistic and intense training program, or face an appropriate penalty. Initially reluctant to comply because of the quest's rigor, 
                Jin-Woo soon finds that it may just transform him into one of the world's most fearsome Hunters.
            </p>


        </div>
    </div>
</div>

{{-- Review Form --}}
<div class="section-header">Write a Review</div>
<div class="glass-card">
    <form action="{{ route('frontend.reviews.store', $manga->manga_id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Rating</label><br>
            @for ($i = 1; $i <= 5; $i++)
                <span class="star inactive" data-value="{{ $i }}">★</span>
            @endfor
            <input type="hidden" name="rating" id="rating-input" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Comment</label>
            <textarea name="comment" class="input" rows="3" placeholder="Write your thoughts..."></textarea>
        </div>
        <div class="text-end">
            <button type="submit" class="btn-orange">Submit Review</button>
        </div>
    </form>
</div>

<div class="section-header">Reviews</div>
@forelse ($manga->reviews as $review)
    <div class="review-card">
        <div class="review-header">
            <div class="review-avatar">
                {{ strtoupper(substr($review->user->username ?? 'A', 0, 1)) }}
            </div>
            <div>
                <strong class="review-username">{{ $review->user->username ?? 'Anonymous' }}</strong><br>
                <div class="review-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= $review->rating ? '' : 'inactive' }}">★</span>
                    @endfor
                </div>
                <small class="review-time text-muted">{{ $review->created_at->diffForHumans() }}</small>
            </div>
        </div>
        <p class="mb-0 review-comment">{{ $review->comment }}</p>

        @auth
            <div class="review-actions">
                @can('update', $review)
                    <a href="{{ route('frontend.reviews.edit', $review->review_id) }}" 
                       class="btn btn-sm btn-edit">Edit</a>
                @endcan

                @can('delete', $review)
                    <form action="{{ route('frontend.reviews.remove', $review->review_id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this review?');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-delete">Delete</button>
                    </form>
                @endcan
            </div>
        @endauth
    </div>
@empty
    <p class="text-muted">No reviews yet.</p>
@endforelse

<script>
    // Star rating interactive
    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', () => {
            let val = star.dataset.value;
            document.getElementById('rating-input').value = val;
            document.querySelectorAll('.star').forEach(s => {
                s.classList.toggle('inactive', s.dataset.value > val);
            });
        });
    });
</script>

<script>
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
                            btn.innerText = "❌ Remove from Favorite";
                            btn.classList.remove("btn-warning");
                            btn.classList.add("btn-danger");
                        } else if (data.status === "removed") {
                            btn.innerText = "⭐ Add to Favorite";
                            btn.classList.remove("btn-danger");
                            btn.classList.add("btn-warning");
                        } else if (data.status === "guest") {
                            alert("Please login before adding to favorites.");
                            window.location.href = "{{ route('login') }}";
                        }
                    });
            });
        }
    });
</script>
@endsection
