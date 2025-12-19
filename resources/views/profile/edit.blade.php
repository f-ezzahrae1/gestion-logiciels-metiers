@extends('layouts.app')

@section('content')
<div class="profile-container">
    <h1 class="profile-header">Mon Profil</h1>
    <div class="profile-sections-grid">
        <div class="profile-section">
            {{-- Includes the form for updating basic profile information --}}
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="profile-section">
            {{-- Includes the form for updating the user's password --}}
            @include('profile.partials.update-password-form')
        </div>

        <div class="profile-section">
            {{-- Includes the form for deleting the user's account --}}
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection