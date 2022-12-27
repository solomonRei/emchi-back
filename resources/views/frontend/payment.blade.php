@extends('layouts.app')

@section('main')
    @parent
    <section
        class="payments rounded-lg md:bg-zinc-50 md:px-7 md:pt-5 md:pb-7 md:shadow-shifted"
    >
        <div class="mb-7">
            <h2
                class="font-display text-2xl font-bold leading-none -tracking-tighter md:text-3xl"
            >
                Мои платежи
            </h2>
        </div>
        <div class="mb-8 flex flex-wrap items-center gap-x-6 gap-y-5 sm:flex-nowrap">
            <div class="grid grow auto-cols-fr grid-flow-col gap-2 sm:gap-4">
                <a
                    href="{{ route('profile.payment', ['type' => 'prepaid']) }}"
                    class="@if(@$_GET['type'] !== 'waiting') active @endif @endifflex min-h-11 grow items-center justify-center rounded bg-white py-2 px-4 text-center transition hover:bg-primary-50 [&amp;.active]:bg-primary-500 [&amp;.active]:text-white"
                >Оплаченные</a
                ><a
                    href="{{ route('profile.payment', ['type' => 'waiting']) }}"
                    class="@if(@$_GET['type'] === 'waiting') active @endif flex min-h-11 grow items-center justify-center rounded bg-white py-2 px-4 text-center transition hover:bg-primary-50 [&amp;.active]:bg-primary-500 [&amp;.active]:text-white"
                >Не оплаченные</a
                >
            </div>
            <details class="dropdown group relative z-[3000] open:drop-shadow ml-auto">
                <summary
                    class="flex cursor-pointer items-center whitespace-nowrap rounded-t px-5 py-3 transition-[color] hover:text-primary-600 group-open:bg-white"
                >
                    Сортировка по дате<svg
                        viewBox="0 0 13 8"
                        class="relative top-0.5 ml-3 h-2 shrink-0 fill-current group-open:top-0 group-open:rotate-180"
                    >
                        <path
                            d="m1.42.06-1.1 1.1L6.5 7.35l6.19-6.19-1.1-1.1L6.5 5.14 1.42.06Z"
                        ></path>
                    </svg>
                </summary>
                <div class="absolute top-full min-w-full rounded-b bg-white pb-2">
                    <a
                        href="{{ route('profile.payment', ['date' => 'latest', 'type' => isset($_GET['type']) && $_GET['type'] === 'waiting' ? 'waiting' : 'prepaid']) }}"
                        class="block py-1.5 px-5 text-xs transition-[color] hover:text-primary-400 [&.active]:font-extrabold @if(@$_GET['date'] !== 'oldest') active @endif"
                    >Сначала новые записи</a
                    ><a
                        href="{{ route('profile.payment', ['date' => 'oldest', 'type' => isset($_GET['type']) && $_GET['type'] === 'waiting' ? 'waiting' : 'prepaid']) }}"
                        class="block py-1.5 px-5 text-xs transition-[color] hover:text-primary-400 [&.active]:font-extrabold @if(@$_GET['date'] === 'oldest') active @endif"
                    >Сначала старые записи</a
                    >
                </div>
            </details>
        </div>
        <div class="">
            @foreach($payments as $payment)
                <article class="payment grid grid-cols-[12px_repeat(2,minmax(0,1fr))] gap-x-7 gap-y-5 py-4 px-5 odd:bg-primary-500/5 sm:grid-cols-[56%_2fr_1fr]">
                    <h3 class="col-span-full flex items-start sm:col-end-auto">
                        <span class="mr-5 -mt-px flex w-5 shrink-0 justify-center"
                        ><svg viewBox="0 0 17 20" class="h-5 fill-current">
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M8.12.04c-.2.07-.35.17-.7.49a8.02 8.02 0 0 1-3.98 2c-.51.1-1.03.15-1.82.19-.54.03-.68.05-.85.12-.26.11-.56.44-.66.7a45.25 45.25 0 0 0-.02 6.07c.29 2.84 1.05 4.91 2.46 6.66.37.46 1.15 1.23 1.61 1.59.99.76 2.1 1.38 3.42 1.89.76.3.95.31 1.45.14.57-.19 1.52-.6 2.1-.93a10.79 10.79 0 0 0 2.52-1.83 9.88 9.88 0 0 0 2.51-3.96 16.44 16.44 0 0 0 .74-3.58 44.94 44.94 0 0 0-.01-6.06c-.1-.26-.4-.58-.66-.69-.17-.07-.3-.1-.81-.12a10.55 10.55 0 0 1-2.36-.31A8.01 8.01 0 0 1 9.5.46C9.32.3 9.1.14 9 .09a1.6 1.6 0 0 0-.87-.05Zm.69 1.39a8.99 8.99 0 0 0 4.71 2.3c.54.08 1.36.16 1.94.18h.3l.02.48c.04.78.03 3.9-.01 4.53-.16 2.39-.67 4.2-1.59 5.7a9.39 9.39 0 0 1-3.95 3.48c-.6.3-1.6.7-1.73.7-.14 0-1.14-.4-1.73-.7a9.38 9.38 0 0 1-3.96-3.5c-.91-1.47-1.42-3.3-1.58-5.68-.04-.63-.05-3.8 0-4.55l.02-.45.3-.01a11.8 11.8 0 0 0 3.7-.66c.5-.19 1.23-.56 1.69-.85a11.72 11.72 0 0 0 1.55-1.24l.32.27ZM7 5.67a.7.7 0 0 0-.2.22c-.06.12-.07.26-.07 1.14v1.01h-1c-.89 0-1.03.01-1.15.07a.7.7 0 0 0-.22.2c-.1.13-.1.15-.1 1.5 0 1.34 0 1.35.1 1.48a.7.7 0 0 0 .22.2c.12.06.26.07 1.14.07h1.01v1c0 .89 0 1.03.07 1.15a.7.7 0 0 0 .2.22c.13.1.14.1 1.49.1s1.36 0 1.49-.1a.7.7 0 0 0 .2-.22c.06-.12.07-.26.07-1.14v-1.01h1c.89 0 1.03 0 1.15-.07a.7.7 0 0 0 .22-.2c.1-.13.1-.14.1-1.49 0-1.34 0-1.36-.1-1.49a.7.7 0 0 0-.22-.2c-.12-.06-.26-.07-1.14-.07h-1.01v-1c0-.89-.01-1.03-.07-1.15a.7.7 0 0 0-.2-.22c-.13-.1-.14-.1-1.49-.1s-1.36 0-1.49.1Zm2.08 2.09c0 .88 0 1.02.06 1.14.04.07.12.17.18.21.1.08.17.09 1.17.1h1.05v1.17l-1.05.01c-1 .02-1.06.02-1.17.1a.72.72 0 0 0-.18.21c-.06.12-.06.26-.06 1.14v1.01H7.9v-1c0-.89 0-1.03-.07-1.15a.72.72 0 0 0-.17-.21c-.1-.08-.17-.08-1.17-.1H5.45V9.21L6.5 9.2c1-.01 1.06-.02 1.17-.1a.72.72 0 0 0 .17-.21c.06-.12.07-.26.07-1.14v-1H9.1v1Z"
                            ></path></svg></span
                        >
                        {{ $payment->service[0]->name }}
                    </h3>
                    <time class="col-start-2 sm:col-start-auto">{{ $payment->date_normal }}</time>
                    <span class="">{{ $payment->finalSum }} ₽</span>
                </article>
            @endforeach

        </div>
        {{ $payments->appends(['date' => isset($_GET['date']) ? $_GET['date'] : 'latest', 'type' => isset($_GET['type']) && $_GET['type'] === 'waiting' ? 'waiting' : 'prepaid'])->links() }}
    </section>
@endsection
