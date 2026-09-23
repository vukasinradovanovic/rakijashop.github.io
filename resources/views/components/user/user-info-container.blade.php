{{-- Container for user img, username, name and e-mail --}}
@props(['isAuth'=>true, 'user'])
@if ($isAuth)
<div class=" d-flex flex-column mt-5 align-items-center ">
    {{-- Profile Image --}}
    <div class="profileInformation_profileImg d-flex justify-content-center align-items-center"
    style="background-image: url('{{optional(Auth::user()->userImg)->img ? asset('storage/' . $user->userImg->img) : asset('img/profile-picture.png') }}');">
    </div>
    <div class="mt-2 text-center">
        <p class="profileInformation_name mb-0">{{ $user->name }} <a
                href="{{ route('user.edit', Auth::id()) }}"><span
                    class="editPencil_btn fa fa-pencil"></span></a></p>
        <p class="profileInformation_username text-secondary mb-1">
            {{ $user->edited_username ? $user->edited_username : $user->default_username }}</p>
        <p class="profileInformation_email">{{ $user->email }}</p>
    </div>

</div>
@else
<div class="d-flex flex-column mb-3 align-items-center mt-1 m-0 bg-primary-color-lighter p-4 text-white border-radius-normal">
    {{-- Profile Image --}}
    <div class="profileInformation_profileImg d-flex justify-content-center align-items-center"
    style="background-image: url('{{optional($user->userImg)->img ? asset('storage/' . $user->userImg->img) : asset('img/profile-picture.png') }}');">
    </div>
    <div class="mt-2 text-center">
        <p class="profileInformation_name mb-0">{{ $user->name }}</p>
        <p class="profileInformation_username text-white-50 mb-0">
            {{ $user->edited_username ? $user->edited_username : $user->default_username }}
        </p>
        <p class="profileInformation_email mb-0">{{ $user->email }}</p>
        <p class="profileInformation_username text-white-50">
            {{  $user->userinfo->city->city ?? ''  }}
        </p>
    </div>
</div> 
@endif