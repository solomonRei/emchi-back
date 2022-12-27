<div class="mb-10 flex flex-wrap items-center gap-x-6 gap-y-3 md:mb-12">
    <h1
        class="mr-auto font-display text-3xl font-bold leading-none -tracking-tighter md:text-5xl"
    >
        Личный кабинет
    </h1>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-2 flex items-center gap-2 transition hover:text-primary-400"
    >Выйти
        <svg viewBox="0 0 20 18" class="w-5 shrink-0 fill-current">
            <path
                d="m15 4-1.41 1.41L16.17 8H6v2h10.17l-2.58 2.58L15 14l5-5-5-5ZM2 2h8V0H2a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h8v-2H2V2Z"
            ></path></svg
        ></a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
