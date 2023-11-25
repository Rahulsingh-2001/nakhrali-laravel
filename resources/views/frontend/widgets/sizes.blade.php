@foreach ($variants as $variant)
    <li class="size_{{ $variant->size->id }}" onclick="selectSize({{ $variant->size->id }})">{{ $variant->size->code }}
    </li>
@endforeach
