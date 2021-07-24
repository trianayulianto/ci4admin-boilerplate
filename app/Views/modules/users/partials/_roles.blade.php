@php
    $rand = rand();    
@endphp
<li class="row my-2" style="border-left:solid 1px #ddd;">
    <i
        class="fas fa-check-square fa-sm"
        style="vertical-align: top; margin-left: -5pt;"
    ></i>
    <button 
        style="text-decoration: none; width:90%;" 
        type="button"
        class="btn ml-4 mb-3 btn-light btn-sm btn-block text-left" 
        data-toggle="collapse" 
        data-target="#collapse-{{ $rand }}"
    >
        <strong>
            Open Roles <i class="fas fa-caret-down float-right"></i>
        </strong>
    </button>
    <ul class="collapse" id="collapse-{{ $rand }}">
        @foreach($roles as $id => $role)
            <li class="row" style="border-left:solid 1px #ddd;">
                <input 
                    class="permission-checkbox" 
                    style="vertical-align: top; margin-left: -5pt; cursor: pointer;"
                    type="checkbox" 
                    id="{{ $role.$id }}" 
                    {{ in_array($id, $hasRoles) ? 'checked' : null }} 
                    name="roles[id][{{ $role }}]" 
                    value="{{ $id }}"
                    @if(!auth()->user()->isSuperUser() && ($role == config('Defender', true)->superuser_role))
                        disabled
                    @endif
                >
                <label 
                    for="{{ $role.$id }}" 
                    class="mt-n2 ml-1" 
                    style="cursor: pointer;"
                >
                    <strong class="text-dark">{{ $role }}</strong>
                    <p class="mb-0 mt-n1 text-muted text-body">
                        <small>{{ 'Mark if the user can have rights as '.$role }}</small>
                    </p>
                </label>
            </li>
        @endforeach
    </ul>
</li>