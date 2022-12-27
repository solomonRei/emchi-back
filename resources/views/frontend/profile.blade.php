@extends('layouts.app')

@section('main')
    @parent
    <section class="profile md:mt-6 md:ml-9">
        <h2
            class="mb-8 font-display text-2xl font-bold leading-none -tracking-tighter md:text-3xl"
        >
            Профиль
        </h2>
        <dl>
            <dt class="mb-2.5 opacity-50">ФИО:</dt>
            <dd class="mb-8">{{ $user->name }} {{ $user->surname }} {{ $user->secondName }}</dd>
            <dt class="mb-2.5 opacity-50">Дата рождения:</dt>
            <dd class="mb-8">{{ $user->birthdate }}</dd>
            <dt class="mb-2.5 opacity-50">Телефон:</dt>
            <dd class="mb-8">{{ $user->phone }}</dd>
            <dt class="mb-2.5 opacity-50">Номер полиса ОМС:</dt>
            <dd class="mb-8">{{ $user->idPolis }}</dd>
            <dt class="mb-2.5 opacity-50">ИНН:</dt>
            <dd class="mb-8">{{ $user->inn }}</dd>
            <dt class="mb-2.5 opacity-50">СНИЛС:</dt>
            <dd class="mb-8">{{ $user->snils }}</dd>
            <dt class="mb-2.5 opacity-50">Место работы:</dt>
            <dd class="mb-8">{{ $user->workplace }}</dd>
        </dl>
    </section>
@endsection
