<section
    class="analyzes rounded-lg md:bg-zinc-50 md:px-7 md:pt-7 md:pb-7 md:shadow-shifted"
>
    <div class="mb-7 flex flex-wrap gap-x-7 gap-y-7 md:flex-nowrap">
        <h2
            class="mr-auto font-display text-2xl font-bold leading-none -tracking-tighter md:text-3xl"
        >
            Результаты анализов
        </h2>
    </div>
    <div class="mb-8 flex flex-wrap items-center gap-x-6 gap-y-5 sm:flex-nowrap">
        <div class="w-full grow sm:min-w-80">
            <form wire:submit.prevent="search" class="search relative">
                <input
                    class="block min-h-[45px] w-full rounded border border-primary-500/10 bg-white py-1 pl-4 pr-12 transition placeholder:text-right placeholder:text-primary-500 placeholder:opacity-50 focus:border-primary-500 focus:outline-none md:border-transparent"
                    wire:model.debounce.500ms="searchTerm"
                    type="text"
                    placeholder="Поиск"
                    required
                /><button
                    type="submit"
                    class="absolute inset-y-0 right-0 flex items-center rounded pt-0.5 pr-5 pl-2 opacity-50"
                >
                    <svg viewBox="0 0 20 20" class="h-5 fill-current">
                        <path
                            d="M7 14c1.76 0 3.37-.66 4.6-1.74l1.34 2.8s.28.22.65.6c.39.36.9.85 1.39 1.36l1.36 1.4.6.64 2.12-2.12-.65-.6-1.39-1.36c-.47-.45-.92-.91-1.37-1.38-.37-.38-.6-.66-.6-.66l-2.8-1.33A7 7 0 1 0 0 7a7 7 0 0 0 7.01 6.99Z"
                        ></path>
                    </svg>
                </button>
            </form>
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
                    wire:click="sortServices('DESC')"
                    class="block py-1.5 px-5 text-xs transition-[color] hover:text-primary-400 [&.active]:font-extrabold cursor-pointer @if($sort_state !== 'oldest') active @endif"
                >Сначала новые записи</a
                ><a
                    wire:click="sortServices('ASC')"
                    class="block py-1.5 px-5 text-xs transition-[color] hover:text-primary-400 [&.active]:font-extrabold cursor-pointer @if($sort_state === 'oldest') active @endif"
                >Сначала старые записи</a
                >
            </div>
        </details>
    </div>
    <div class="grid gap-8">
        @if($analyzes === null || $analyzes->count() === 0)

        @else
            @foreach($analyzes as $analyze)
            <details
                class="analysis group overflow-hidden rounded-lg border border-transparent bg-white shadow-shifted open:border-success-500"
            >
                <summary
                    class="flex cursor-pointer items-center py-5 pl-5 pr-5 group-open:bg-success-500 group-open:text-white sm:pr-7"
                >
                    <div class="flex grow flex-col gap-x-6 gap-y-4 sm:flex-row sm:items-center">
                        <div class="flex items-start break-words sm:w-7/12">
                            <span class="mr-5 -mt-px w-5 shrink-0"
                            ><svg viewBox="0 0 17 20" class="h-5 fill-current">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M8.12.04c-.2.07-.35.17-.7.49a8.02 8.02 0 0 1-3.98 2c-.51.1-1.03.15-1.82.19-.54.03-.68.05-.85.12-.26.11-.56.44-.66.7a45.25 45.25 0 0 0-.02 6.07c.29 2.84 1.05 4.91 2.46 6.66.37.46 1.15 1.23 1.61 1.59.99.76 2.1 1.38 3.42 1.89.76.3.95.31 1.45.14.57-.19 1.52-.6 2.1-.93a10.79 10.79 0 0 0 2.52-1.83 9.88 9.88 0 0 0 2.51-3.96 16.44 16.44 0 0 0 .74-3.58 44.94 44.94 0 0 0-.01-6.06c-.1-.26-.4-.58-.66-.69-.17-.07-.3-.1-.81-.12a10.55 10.55 0 0 1-2.36-.31A8.01 8.01 0 0 1 9.5.46C9.32.3 9.1.14 9 .09a1.6 1.6 0 0 0-.87-.05Zm.69 1.39a8.99 8.99 0 0 0 4.71 2.3c.54.08 1.36.16 1.94.18h.3l.02.48c.04.78.03 3.9-.01 4.53-.16 2.39-.67 4.2-1.59 5.7a9.39 9.39 0 0 1-3.95 3.48c-.6.3-1.6.7-1.73.7-.14 0-1.14-.4-1.73-.7a9.38 9.38 0 0 1-3.96-3.5c-.91-1.47-1.42-3.3-1.58-5.68-.04-.63-.05-3.8 0-4.55l.02-.45.3-.01a11.8 11.8 0 0 0 3.7-.66c.5-.19 1.23-.56 1.69-.85a11.72 11.72 0 0 0 1.55-1.24l.32.27ZM7 5.67a.7.7 0 0 0-.2.22c-.06.12-.07.26-.07 1.14v1.01h-1c-.89 0-1.03.01-1.15.07a.7.7 0 0 0-.22.2c-.1.13-.1.15-.1 1.5 0 1.34 0 1.35.1 1.48a.7.7 0 0 0 .22.2c.12.06.26.07 1.14.07h1.01v1c0 .89 0 1.03.07 1.15a.7.7 0 0 0 .2.22c.13.1.14.1 1.49.1s1.36 0 1.49-.1a.7.7 0 0 0 .2-.22c.06-.12.07-.26.07-1.14v-1.01h1c.89 0 1.03 0 1.15-.07a.7.7 0 0 0 .22-.2c.1-.13.1-.14.1-1.49 0-1.34 0-1.36-.1-1.49a.7.7 0 0 0-.22-.2c-.12-.06-.26-.07-1.14-.07h-1.01v-1c0-.89-.01-1.03-.07-1.15a.7.7 0 0 0-.2-.22c-.13-.1-.14-.1-1.49-.1s-1.36 0-1.49.1Zm2.08 2.09c0 .88 0 1.02.06 1.14.04.07.12.17.18.21.1.08.17.09 1.17.1h1.05v1.17l-1.05.01c-1 .02-1.06.02-1.17.1a.72.72 0 0 0-.18.21c-.06.12-.06.26-.06 1.14v1.01H7.9v-1c0-.89 0-1.03-.07-1.15a.72.72 0 0 0-.17-.21c-.1-.08-.17-.08-1.17-.1H5.45V9.21L6.5 9.2c1-.01 1.06-.02 1.17-.1a.72.72 0 0 0 .17-.21c.06-.12.07-.26.07-1.14v-1H9.1v1Z"
                                ></path></svg></span
                            >{{ $analyze->title }}
                        </div>
                        <time class="ml-10 grow sm:ml-0 sm:text-center"
                        >{{ $analyze->date_normal }}</time
                        >
                    </div>
                    <svg
                        viewBox="0 0 13 8"
                        class="ml-5 h-2 shrink-0 fill-current group-open:top-0 group-open:rotate-180"
                    >
                        <path
                            d="m1.42.06-1.1 1.1L6.5 7.35l6.19-6.19-1.1-1.1L6.5 5.14 1.42.06Z"
                        ></path>
                    </svg>
                </summary>
                <div class="grid sm:grid-cols-2">
                    <div class="flex flex-col items-start px-5 pb-7 pt-7 sm:pb-5">
                        <div class="mb-9 grid gap-7">
                            <span class="flex items-center gap-5"
                            ><i class="flex w-5 items-center justify-center"
                                ><svg viewBox="0 0 21 20" class="h-5 shrink-0 fill-current">
                                  <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M7.31.07a3.09 3.09 0 0 0-2.06 1.94l-.11.3V6c0 3.65 0 3.68.08 4 .12.44.3.85.5 1.2l.18.3c-.01.02-.69.44-1.5.95l-1.84 1.17c-.44.3-1.13.98-1.46 1.45-.3.43-.67 1.16-.83 1.66A6.01 6.01 0 0 0 0 18.86v.85l.15.14.15.15h19.4l.15-.15.14-.14v-1a5.39 5.39 0 0 0-.27-2.04 7.5 7.5 0 0 0-.8-1.6 7.32 7.32 0 0 0-1.33-1.36l-1.88-1.2-1.6-1 .1-.2c.31-.48.55-1.1.64-1.66.03-.2.04-1.27.03-3.81l-.01-3.52-.1-.31a3.81 3.81 0 0 0-.26-.57A3.95 3.95 0 0 0 13.45.37c-.14-.08-.4-.2-.57-.25l-.3-.1-2.5-.02c-2.35 0-2.5 0-2.77.07Zm4.85 1.14c.8.1 1.42.72 1.53 1.52.02.16.03 1.08.03 2.04v1.75H6.3V4.77c0-.96.02-1.88.04-2.04a1.75 1.75 0 0 1 1.49-1.52 68.3 68.3 0 0 1 4.34 0Zm-2.4 1.13a.85.85 0 0 0-.2.15c-.1.12-.12.15-.13.45l-.01.33-.33.01c-.32.02-.33.02-.48.16-.14.15-.15.16-.15.42 0 .27.01.28.15.42.15.15.16.15.48.17h.33v.34c.02.32.03.33.17.47.14.14.16.15.42.15s.28 0 .42-.15c.14-.14.15-.15.16-.47l.01-.33.33-.01c.32-.02.33-.02.48-.17.14-.14.14-.15.14-.42 0-.26 0-.27-.14-.42-.15-.14-.16-.14-.48-.16l-.33-.01-.01-.33c-.01-.32-.02-.33-.16-.47-.13-.13-.17-.15-.37-.16-.12 0-.26 0-.3.03Zm3.95 6.23c-.01.66-.04.9-.1 1.14-.15.6-.45 1.1-.89 1.51-.42.4-.83.63-1.4.79-.28.07-.4.08-1.31.08-.9 0-1.03 0-1.31-.08a3.08 3.08 0 0 1-1.4-.79 3.12 3.12 0 0 1-.9-1.5 4.91 4.91 0 0 1-.1-1.15l-.02-.83h7.46l-.03.83Zm-7.46 5.01v.84l-.14.06c-.4.18-.81.63-.95 1.07-.1.34-.1.78 0 1.12.16.5.62.96 1.13 1.12a1.97 1.97 0 0 0 1.1 0c.52-.16.98-.62 1.13-1.12.1-.34.1-.78 0-1.12a2 2 0 0 0-.24-.47 2 2 0 0 0-.72-.6l-.1-.02v-1.64l.17.08a4.32 4.32 0 0 0 2.38.4 4.32 4.32 0 0 0 2.56-.47c.01 0 .02.32.02.73v.74l-.54.01c-.52.02-.54.02-.78.15-.28.15-.43.3-.59.6-.1.2-.1.22-.12 1.02-.01.94.01 1.05.28 1.31.24.25.4.3 1.02.28l.53-.02.15-.14c.14-.15.15-.16.15-.42 0-.27 0-.28-.15-.42-.14-.15-.15-.15-.48-.17h-.34l.02-.45c0-.3.03-.46.06-.5a5.9 5.9 0 0 1 1.38-.05 5.9 5.9 0 0 1 1.37.05c.04.04.06.2.07.5l.01.44-.33.01c-.33.02-.34.02-.49.17-.14.14-.14.15-.14.42 0 .26 0 .27.14.42l.15.14.53.02c.63.01.78-.03 1.03-.28.26-.26.29-.37.27-1.3l-.01-.82-.13-.25a1.3 1.3 0 0 0-.6-.58c-.2-.1-.26-.11-.73-.12l-.52-.02v-1.56l.2.13 1.43.9c.66.41 1.34.85 1.5.98a4.97 4.97 0 0 1 1.9 3.7l.02.4H1.17l.02-.39a4.9 4.9 0 0 1 1.87-3.7c.27-.2 3.1-2 3.16-2.01.02 0 .03.37.03.83Zm.88 2.05c.15.08.26.27.26.48 0 .32-.22.55-.55.55a.53.53 0 0 1-.47-.25c-.13-.22-.08-.58.1-.73.1-.08.34-.16.45-.13l.2.08Z"
                                  ></path></svg></i
                                >Лечащий врач: {{ $analyze->doctor->fio }}</span
                            ><span class="flex items-center gap-5"
                            ><i class="flex w-5 items-center justify-center"
                                ><svg viewBox="0 0 16 20" class="h-5 shrink-0 fill-current">
                                  <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M6.86.06a9.3 9.3 0 0 0-1.52.37 8.2 8.2 0 0 0-5.1 5.64A7.08 7.08 0 0 0 0 8.04c0 .9.06 1.42.29 2.3.19.74.43 1.39.82 2.18.64 1.31 1.46 2.5 2.64 3.85.5.56 1.51 1.58 2.07 2.07l.43.37-.63.02c-.55.02-.64.03-.74.1a.67.67 0 0 0-.25.48c0 .19.12.4.28.5l.13.09h5.92l.13-.09c.16-.1.28-.31.28-.5a.65.65 0 0 0-.25-.48c-.1-.07-.19-.09-.74-.1l-.63-.02.43-.37c.23-.2.7-.66 1.05-1a18.36 18.36 0 0 0 3.66-4.92c.39-.8.63-1.45.82-2.19.23-.89.3-1.4.29-2.29a8.21 8.21 0 0 0-2.99-6.3 8.84 8.84 0 0 0-2.3-1.3A9.23 9.23 0 0 0 9.1.07c-.55-.08-1.72-.08-2.25 0Zm2.02 1.19c.44.05 1.12.23 1.52.38a7.21 7.21 0 0 1 2.97 2.22 7.19 7.19 0 0 1 1.33 3.01c.07.36.08.62.08 1.2 0 .53-.01.86-.06 1.13a9.84 9.84 0 0 1-.87 2.67c-.34.71-.62 1.19-1.08 1.88A21.48 21.48 0 0 1 8 18.64c-.02 0-.2-.15-.42-.31A24.32 24.32 0 0 1 3.8 14.5c-.38-.5-1.04-1.48-1.32-2-.33-.6-.6-1.23-.82-1.86a7.03 7.03 0 0 1 2.44-8.2 6.64 6.64 0 0 1 4.8-1.2ZM7.25 2.89c-.3.04-.81.18-1.12.3a6 6 0 0 0-1.22.66c-.38.27-.91.8-1.2 1.2a5.48 5.48 0 0 0-.9 2.17 5.37 5.37 0 0 0 .67 3.54 5.3 5.3 0 0 0 3.28 2.43c.32.08.53.1 1.05.12a5.28 5.28 0 0 0 5.38-4.37c.07-.47.07-1.24 0-1.72a5.56 5.56 0 0 0-.86-2.1A5.43 5.43 0 0 0 7.25 2.9ZM9 4.17c.43.11.88.32 1.25.57a3.95 3.95 0 0 1 1.65 4.42c-.12.45-.38.98-.64 1.33a4.4 4.4 0 0 1-.99.94 4.8 4.8 0 0 1-1.24.57c-.3.08-.43.09-1.02.09-.6 0-.73-.01-1.02-.1A4.11 4.11 0 0 1 4.1 9.17c-.08-.29-.1-.47-.12-.92a3.96 3.96 0 0 1 1.08-2.9 3.92 3.92 0 0 1 3.06-1.27c.4.02.65.04.87.1ZM7.75 6.4a.85.85 0 0 0-.2.16c-.11.12-.12.14-.13.53l-.01.4h-.36c-.28 0-.4.02-.5.08a.73.73 0 0 0-.31.51c0 .17.16.44.31.53.1.06.23.08.5.1h.36v.36c0 .26.02.38.07.47.22.37.82.37 1.04 0 .05-.1.07-.2.07-.47v-.35l.36-.02c.27-.01.4-.03.5-.1a.77.77 0 0 0 .31-.52.73.73 0 0 0-.31-.51c-.1-.06-.22-.07-.5-.07H8.6v-.41l-.02-.41-.15-.15c-.13-.13-.17-.14-.37-.15a.83.83 0 0 0-.3.02Z"
                                  ></path></svg></i
                                >Код. {{ $analyze->number }}</span
                            ><span class="flex items-center gap-5"
                            ><i class="flex w-5 items-center justify-center"
                                ><svg viewBox="0 0 21 20" class="h-5 shrink-0 fill-current">
                                  <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M8.23.05a2.95 2.95 0 0 0-1.88 4.42l.13.2H4.01c-2.69 0-2.73.01-3.11.23a2 2 0 0 0-.65.65c-.26.43-.25.04-.25 6.79s-.01 6.36.25 6.8c.14.24.4.49.65.64.4.23-.1.22 8.45.22 7.13 0 7.83 0 7.95-.06a.68.68 0 0 0 .22-.19c.09-.12.09-.14.1-1.71v-1.6h.43a1.78 1.78 0 0 0 1.9-1.32c.06-.2.06-.46.05-1.71 0-1.43-.01-1.49-.1-1.7a1.94 1.94 0 0 0-1-1.01 2.1 2.1 0 0 0-.76-.11l-.51-.02V9.03c0-1.7 0-1.72-.25-1.9-.1-.07-.19-.09-.52-.1l-.4-.01-.01-.99c-.02-.94-.02-.98-.1-1.1-.19-.26-.1-.25-2.76-.25h-2.4l.13-.2a3.01 3.01 0 0 0 .33-2.4A3.02 3.02 0 0 0 9.67.11 3.7 3.7 0 0 0 8.23.05Zm.92 1.15c.73.14 1.29.72 1.41 1.46a1.76 1.76 0 0 1-1.98 1.98A1.76 1.76 0 0 1 7.1 3.19 1.76 1.76 0 0 1 9.15 1.2Zm-.58 1.2a.59.59 0 0 0-.31.46c-.04.32.18.6.51.64.33.03.6-.19.64-.52a.59.59 0 0 0-.24-.54.67.67 0 0 0-.6-.04Zm6.71 4.04v.58h-6.8c-6.8 0-6.81 0-6.98-.08a.48.48 0 0 1-.25-.24.8.8 0 0 1-.08-.26.8.8 0 0 1 .08-.26.49.49 0 0 1 .25-.25l.16-.08h13.62v.59ZM8.9 8.19h7.55v2.38l-1.16.02a4.44 4.44 0 0 0-1.43.1 3.04 3.04 0 0 0-1.99 2c-.07.25-.09.38-.09.82 0 .44.02.58.1.82a3.03 3.03 0 0 0 1.97 2c.26.08.36.1 1.44.1l1.16.02v2.38H9.06c-7.39 0-7.4 0-7.56-.08a.48.48 0 0 1-.25-.25c-.08-.17-.08-.2-.08-5.28V8.11l.1.03c.04.02 3.48.04 7.63.05Zm9.61 3.64a.5.5 0 0 1 .25.25c.08.17.08.22.07 1.48-.01 1.26-.01 1.32-.1 1.42-.04.06-.12.15-.18.2-.1.07-.16.07-2.03.08-1.2 0-2 0-2.13-.03a1.77 1.77 0 0 1-1.42-1.46 1.76 1.76 0 0 1 1.38-1.97c.1-.02 1.03-.04 2.08-.04 1.86 0 1.92 0 2.08.07ZM14.43 13a.59.59 0 0 0-.31.46c-.04.33.19.6.51.64.33.04.6-.19.64-.52a.59.59 0 0 0-.23-.53.67.67 0 0 0-.61-.05Z"
                                  ></path></svg></i
                                >{{ $analyze->finalSum }} ₽</span
                            >
                        </div>
                        <div class="mt-auto">
                            <a
                                data-hk="0-0-0-0-1-11-5-0-0-3-5-0-0"
                                class="button relative inline-flex cursor-pointer items-center justify-center text-center align-middle transition bg-primary-500 text-white hover:bg-primary-400 active:bg-primary-600 min-h-[45px] py-1 px-5 text-base rounded"
                                href="#"
                            >Записаться на прием</a
                            >
                        </div>
                    </div>
                    <div
                        class="flex flex-col items-start border-t border-primary-500/10 px-6 pb-7 pt-7 sm:border-t-0 sm:border-l sm:pb-5" style="display: none"
                    >
                        <div class="mb-3">Результат:</div>
                        <p class="mb-7 font-light">
                            Таким образом, социально-экономическое развитие создаёт предпосылки для
                            приоретизации разума над эмоциями. С другой стороны, выбранный нами
                            инновационный путь говорит о возможностях благоприятных перспектив. А
                            ещё непосредственные участники технического прогресса являются только
                            методом политического участия и объединены в целые кластеры себе.
                        </p>
                        @if(isset($analyze->token_pdf) && !empty($analyze->token_pdf))
                            <div class="mt-auto">
                                <a
                                    data-hk="0-0-0-0-1-11-5-0-0-3-6-0-0"
                                    class="button relative inline-flex cursor-pointer items-center justify-center text-center align-middle transition text-primary-500 hover:bg-primary-500 hover:text-white border border-primary-500 active:bg-primary-600 active:text-white active:border-primary-600 min-h-[45px] py-1 px-5 text-base rounded"
                                    href="{{ route('profile.get-pdf', ['id' => $analyze->token_pdf]) }}"
                                >Скачать результат</a
                                >
                            </div>
                        @endif
                    </div>
                </div>
            </details>
        @endforeach
        @endif
    </div>
    @if($analyzes !== null && $analyzes->count() !== 0)
        {{ $analyzes->links('vendor.pagination.custom-pagination', ['route' => route('profile.services')]) }}
    @endif
</section>
