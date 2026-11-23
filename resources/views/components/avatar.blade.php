@props(['user', 'size' => 40])
@if($user->photo_url)
    <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
         style="width:{{ $size }}px;height:{{ $size }}px;border-radius:50%;object-fit:cover">
@else
    <span style="width:{{ $size }}px;height:{{ $size }}px;border-radius:50%;background:#6b7280;color:#fff;
                 display:inline-flex;align-items:center;justify-content:center;font-weight:600;font-size:{{ $size / 2.4 }}px">
        {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
    </span>
@endif