@php
    $rand = rand();    
@endphp
<li class="row my-2" style="border-left:solid 1px #ddd;">
    <i
        class="fas fa-check-square fa-sm"
        style="vertical-align: top; margin-left: -5pt;"
    ></i>
    <label 
        for="{{ $rand }}"
        class="mt-n2 ml-2" 
        style="cursor: pointer;"
    >
        <strong class="text-dark">{{ $menus['name'] }}</strong>
        <p class="mb-0 mt-n1 text-muted text-body">
            <small>
                {{ $menus['description'] }}
            </small>
        </p>
    </label>
    <button 
        style="text-decoration: none; width:90%;" 
        type="button"
        class="btn ml-4 mb-3 btn-light btn-sm btn-block text-left" 
        data-toggle="collapse" 
        data-target="#collapse-{{ $rand }}"
    >
        <strong>
            Open Permission <i class="fas fa-caret-down float-right"></i>
        </strong>
    </button>
    <ul class="collapse" id="collapse-{{ $rand }}">
        @foreach($menus['permissions'] as $key => $menu)
            <li class="row" style="border-left:solid 1px #ddd;">
                <input 
                    class="permission-checkbox" 
                    style="vertical-align: top; margin-left: -5pt; cursor: pointer;" 
                    type="checkbox" 
                    id="{{ $menu['name'].$menu['id'] }}" 
                    {{ in_array($menu['id'], $hasPermissions) ? 'checked' : null }} 
                    name="permissions[id][]" 
                    value="{{ $menu['id'] }}"
                >
                <label 
                    for="{{ $menu['name'].$menu['id'] }}" 
                    class="mt-n2 ml-1" 
                    style="cursor: pointer;"
                >
                    <strong class="text-dark">{{ $menu['name'] }}</strong>
                    <p class="mb-0 mt-n1 text-muted text-body">
                        <small>{{ $menu['readable_name'] }}</small>
                    </p>
                </label>
            </li>
        @endforeach
    </ul>
</li>