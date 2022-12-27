@extends('layouts.app')

@section('main')
    @parent
    <section
        class="services rounded-lg md:bg-zinc-50 md:px-7 md:pt-5 md:pb-7 md:shadow-shifted"
    >
        <div class="mb-7">
            <h2
                class="font-display text-2xl font-bold leading-none -tracking-tighter md:text-3xl"
            >
                Мои услуги
            </h2>
        </div>
        <div class="mb-8 flex flex-wrap items-center gap-x-6 gap-y-5 sm:flex-nowrap">
            <div class="grid grow auto-cols-fr grid-flow-col gap-2 sm:gap-4">
                <a
                    href="#"
                    class="flex min-h-11 grow items-center justify-center rounded bg-white py-2 px-4 text-center transition hover:bg-primary-50 [&amp;.active]:bg-primary-500 [&amp;.active]:text-white"
                >Все услуги</a
                ><a
                    href="#"
                    class="active flex min-h-11 grow items-center justify-center rounded bg-white py-2 px-4 text-center transition hover:bg-primary-50 [&amp;.active]:bg-primary-500 [&amp;.active]:text-white"
                >Мои услуги</a
                >
            </div>
            <details class="dropdown group relative z-[3000] open:drop-shadow ml-auto">
                <summary
                    class="flex cursor-pointer items-center whitespace-nowrap rounded-t px-5 py-3 transition-[color] hover:text-primary-600 group-open:bg-white"
                >
                    Сортировка по дате
                    <svg
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
                        href="{{ route('profile.services', ['date' => 'latest']) }}"
                        class="block py-1.5 px-5 text-xs transition-[color] hover:text-primary-400 [&.active]:font-extrabold @if(@$_GET['date'] !== 'oldest') active @endif"
                    >Сначала новые записи</a
                    ><a
                        href="{{ route('profile.services', ['date' => 'oldest']) }}"
                        class="block py-1.5 px-5 text-xs transition-[color] hover:text-primary-400 [&.active]:font-extrabold @if(@$_GET['date'] === 'oldest') active @endif"
                    >Сначала старые записи</a
                    >
                </div>
            </details>
        </div>
        <div class="grid gap-8">
            @foreach($my_services as $my_service)
                <article class="service rounded-lg bg-white shadow-shifted">
                    <div class="grid sm:grid-cols-[38%_minmax(0,1fr)]">
                        <div class="relative aspect-[5/2] sm:aspect-auto">
                            <img
                                src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=80"
                                alt="#"
                                loading="lazy"
                                decoding="async"
                                class="absolute top-0 left-0 h-full w-full rounded-t-lg object-cover sm:rounded-t-none sm:rounded-l-lg"
                            />
                        </div>
                        <div class="p-5">
                            <div class="mb-5 flex items-start">
                            <span class="mr-5 w-5 shrink-0"
                            ><svg viewBox="0 0 17 20" class="h-5 fill-current">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M8.12.04c-.2.07-.35.17-.7.49a8.02 8.02 0 0 1-3.98 2c-.51.1-1.03.15-1.82.19-.54.03-.68.05-.85.12-.26.11-.56.44-.66.7a45.25 45.25 0 0 0-.02 6.07c.29 2.84 1.05 4.91 2.46 6.66.37.46 1.15 1.23 1.61 1.59.99.76 2.1 1.38 3.42 1.89.76.3.95.31 1.45.14.57-.19 1.52-.6 2.1-.93a10.79 10.79 0 0 0 2.52-1.83 9.88 9.88 0 0 0 2.51-3.96 16.44 16.44 0 0 0 .74-3.58 44.94 44.94 0 0 0-.01-6.06c-.1-.26-.4-.58-.66-.69-.17-.07-.3-.1-.81-.12a10.55 10.55 0 0 1-2.36-.31A8.01 8.01 0 0 1 9.5.46C9.32.3 9.1.14 9 .09a1.6 1.6 0 0 0-.87-.05Zm.69 1.39a8.99 8.99 0 0 0 4.71 2.3c.54.08 1.36.16 1.94.18h.3l.02.48c.04.78.03 3.9-.01 4.53-.16 2.39-.67 4.2-1.59 5.7a9.39 9.39 0 0 1-3.95 3.48c-.6.3-1.6.7-1.73.7-.14 0-1.14-.4-1.73-.7a9.38 9.38 0 0 1-3.96-3.5c-.91-1.47-1.42-3.3-1.58-5.68-.04-.63-.05-3.8 0-4.55l.02-.45.3-.01a11.8 11.8 0 0 0 3.7-.66c.5-.19 1.23-.56 1.69-.85a11.72 11.72 0 0 0 1.55-1.24l.32.27ZM7 5.67a.7.7 0 0 0-.2.22c-.06.12-.07.26-.07 1.14v1.01h-1c-.89 0-1.03.01-1.15.07a.7.7 0 0 0-.22.2c-.1.13-.1.15-.1 1.5 0 1.34 0 1.35.1 1.48a.7.7 0 0 0 .22.2c.12.06.26.07 1.14.07h1.01v1c0 .89 0 1.03.07 1.15a.7.7 0 0 0 .2.22c.13.1.14.1 1.49.1s1.36 0 1.49-.1a.7.7 0 0 0 .2-.22c.06-.12.07-.26.07-1.14v-1.01h1c.89 0 1.03 0 1.15-.07a.7.7 0 0 0 .22-.2c.1-.13.1-.14.1-1.49 0-1.34 0-1.36-.1-1.49a.7.7 0 0 0-.22-.2c-.12-.06-.26-.07-1.14-.07h-1.01v-1c0-.89-.01-1.03-.07-1.15a.7.7 0 0 0-.2-.22c-.13-.1-.14-.1-1.49-.1s-1.36 0-1.49.1Zm2.08 2.09c0 .88 0 1.02.06 1.14.04.07.12.17.18.21.1.08.17.09 1.17.1h1.05v1.17l-1.05.01c-1 .02-1.06.02-1.17.1a.72.72 0 0 0-.18.21c-.06.12-.06.26-.06 1.14v1.01H7.9v-1c0-.89 0-1.03-.07-1.15a.72.72 0 0 0-.17-.21c-.1-.08-.17-.08-1.17-.1H5.45V9.21L6.5 9.2c1-.01 1.06-.02 1.17-.1a.72.72 0 0 0 .17-.21c.06-.12.07-.26.07-1.14v-1H9.1v1Z"
                                ></path></svg
                                ></span>
                                <h3 class="min-h-[2.3em] break-words text-xl leading-tightest">
                                    {{ $my_service->name }}
                                </h3>
                            </div>
                            <div class="ml-10 mb-5">
                                <p class="font-light">
                                    Краткое описание процедуры вещь: синтетическое тестирование играет
                                    определяющее значение для стандартных
                                </p>
                            </div>
                            <div class="mb-6 flex flex-wrap gap-x-12 gap-y-4 whitespace-nowrap">
                                <div class="flex items-center">
                              <span class="mr-5 -mt-px w-5 shrink-0"
                              ><svg viewBox="0 0 21 20" class="h-5 fill-current">
                                  <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M8.23.05a2.95 2.95 0 0 0-1.88 4.42l.13.2H4.01c-2.69 0-2.73.01-3.11.23a2 2 0 0 0-.65.65c-.26.43-.25.04-.25 6.79s-.01 6.36.25 6.8c.14.24.4.49.65.64.4.23-.1.22 8.45.22 7.13 0 7.83 0 7.95-.06a.68.68 0 0 0 .22-.19c.09-.12.09-.14.1-1.71v-1.6h.43a1.78 1.78 0 0 0 1.9-1.32c.06-.2.06-.46.05-1.71 0-1.43-.01-1.49-.1-1.7a1.94 1.94 0 0 0-1-1.01 2.1 2.1 0 0 0-.76-.11l-.51-.02V9.03c0-1.7 0-1.72-.25-1.9-.1-.07-.19-.09-.52-.1l-.4-.01-.01-.99c-.02-.94-.02-.98-.1-1.1-.19-.26-.1-.25-2.76-.25h-2.4l.13-.2a3.01 3.01 0 0 0 .33-2.4A3.02 3.02 0 0 0 9.67.11 3.7 3.7 0 0 0 8.23.05Zm.92 1.15c.73.14 1.29.72 1.41 1.46a1.76 1.76 0 0 1-1.98 1.98A1.76 1.76 0 0 1 7.1 3.19 1.76 1.76 0 0 1 9.15 1.2Zm-.58 1.2a.59.59 0 0 0-.31.46c-.04.32.18.6.51.64.33.03.6-.19.64-.52a.59.59 0 0 0-.24-.54.67.67 0 0 0-.6-.04Zm6.71 4.04v.58h-6.8c-6.8 0-6.81 0-6.98-.08a.48.48 0 0 1-.25-.24.8.8 0 0 1-.08-.26.8.8 0 0 1 .08-.26.49.49 0 0 1 .25-.25l.16-.08h13.62v.59ZM8.9 8.19h7.55v2.38l-1.16.02a4.44 4.44 0 0 0-1.43.1 3.04 3.04 0 0 0-1.99 2c-.07.25-.09.38-.09.82 0 .44.02.58.1.82a3.03 3.03 0 0 0 1.97 2c.26.08.36.1 1.44.1l1.16.02v2.38H9.06c-7.39 0-7.4 0-7.56-.08a.48.48 0 0 1-.25-.25c-.08-.17-.08-.2-.08-5.28V8.11l.1.03c.04.02 3.48.04 7.63.05Zm9.61 3.64a.5.5 0 0 1 .25.25c.08.17.08.22.07 1.48-.01 1.26-.01 1.32-.1 1.42-.04.06-.12.15-.18.2-.1.07-.16.07-2.03.08-1.2 0-2 0-2.13-.03a1.77 1.77 0 0 1-1.42-1.46 1.76 1.76 0 0 1 1.38-1.97c.1-.02 1.03-.04 2.08-.04 1.86 0 1.92 0 2.08.07ZM14.43 13a.59.59 0 0 0-.31.46c-.04.33.19.6.51.64.33.04.6-.19.64-.52a.59.59 0 0 0-.23-.53.67.67 0 0 0-.61-.05Z"
                                  ></path></svg></span
                              ><span>{{ $my_service->finalSum }} ₽</span>
                                </div>
                                <div class="flex items-center">
                              <span class="mr-5 w-5 shrink-0"
                              ><svg viewBox="0 0 20 20" class="h-5 fill-current">
                                  <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M3.88.05a.71.71 0 0 0-.22.19c-.07.1-.09.18-.1.54l-.01.42h-1.6c-1.56.02-1.58.02-1.7.1a.68.68 0 0 0-.19.23c-.05.12-.06.81-.06 7.9 0 7.08 0 7.77.06 7.9a.8.8 0 0 0 .19.22l.12.08 4.99.01 4.99.02.14.2a5.46 5.46 0 0 0 3.54 2.1 5.37 5.37 0 0 0 3.12-.55c.54-.3.84-.52 1.29-.97a5.3 5.3 0 0 0 .5-6.89l-.11-.14V6.54c0-4.42 0-4.89-.07-5.01a.68.68 0 0 0-.18-.22c-.12-.09-.14-.09-1.71-.1l-1.6-.01V.82c0-.42-.05-.59-.25-.72-.09-.07-.17-.1-.33-.1s-.25.03-.34.1c-.2.13-.25.3-.25.73v.37h-2.34V.83c0-.43-.06-.6-.25-.73a.51.51 0 0 0-.34-.1.51.51 0 0 0-.34.1c-.19.13-.24.3-.24.73v.37H8.24V.83C8.24.4 8.2.23 8 .1 7.9.03 7.82 0 7.66 0s-.25.03-.34.1c-.2.13-.25.3-.25.73v.37H4.73V.83c0-.43-.06-.6-.25-.73a.67.67 0 0 0-.6-.05Zm-.33 2.68c0 .4.06.57.25.7.1.07.18.1.34.1.16 0 .25-.03.34-.1.19-.13.25-.3.25-.7v-.36h2.34v.36c0 .4.06.57.25.7.09.07.18.1.34.1.16 0 .24-.03.33-.1.2-.13.25-.3.25-.7v-.36h2.36v.36c0 .4.05.57.24.7.1.07.18.1.34.1.16 0 .25-.03.34-.1.19-.13.25-.3.25-.7v-.36h2.34v.36c0 .4.06.57.25.7.1.07.18.1.34.1.16 0 .24-.03.33-.1.2-.13.25-.3.25-.7v-.36h2.38v2.35H1.17V2.37h2.38v.36Zm14.1 5.37v2.2a5.86 5.86 0 0 0-1.82-.75 4.64 4.64 0 0 0-1.1-.08c-.5 0-.77.01-1 .07a5.3 5.3 0 0 0-3.17 1.96l-.24.3h-.78c-.67-.01-.8 0-.93.05a.7.7 0 0 0-.22.2c-.07.08-.09.17-.09.33s.02.24.09.34c.15.2.29.24.84.24.37 0 .5.02.5.05l-.08.3c-.04.14-.1.38-.12.54l-.05.29h-.37c-.42 0-.58.05-.72.25-.07.09-.09.17-.09.33s.02.25.09.34c.14.2.3.25.72.25h.37l.05.29a4.96 4.96 0 0 0 .2.83c0 .04-.88.05-4.28.05H1.17V5.9h16.49v2.2ZM3.89 7.17a.69.69 0 0 0-.22.18.57.57 0 0 0-.09.34c0 .16.03.24.1.34.15.22.27.24 1.06.24s.9-.02 1.06-.24c.07-.1.09-.18.09-.34 0-.16-.02-.25-.09-.34-.16-.22-.27-.25-1.07-.25-.58 0-.74.02-.84.07Zm4.72 0a.69.69 0 0 0-.21.18c-.07.1-.09.18-.09.34 0 .16.02.24.09.34.16.22.27.24 1.06.24.8 0 .91-.02 1.07-.24.06-.1.09-.18.09-.34 0-.16-.03-.25-.1-.34-.15-.22-.26-.25-1.06-.25-.58 0-.74.02-.85.07Zm4.69 0a.7.7 0 0 0-.22.18.57.57 0 0 0-.08.34c0 .16.02.24.09.34.15.22.27.24 1.06.24.8 0 .9-.02 1.07-.24.06-.1.08-.18.08-.34 0-.16-.02-.25-.08-.34-.16-.22-.28-.25-1.08-.25-.58 0-.74.02-.84.07ZM3.88 9.5a.69.69 0 0 0-.22.19c-.06.09-.09.17-.09.33s.03.25.1.34c.15.22.27.25 1.06.25s.9-.03 1.06-.25c.07-.09.09-.18.09-.34 0-.16-.02-.24-.09-.33-.16-.23-.27-.25-1.07-.25-.58 0-.74.01-.84.06Zm4.72 0a.69.69 0 0 0-.21.19c-.07.09-.09.17-.09.33s.02.25.09.34c.16.22.27.25 1.06.25.8 0 .91-.03 1.07-.25a.55.55 0 0 0 .09-.34c0-.16-.03-.24-.1-.33-.15-.23-.26-.25-1.06-.25-.58 0-.74.01-.85.06Zm6.6 1.15a4.01 4.01 0 0 1 2.41 1.17 3.97 3.97 0 0 1 1.18 2.49 4 4 0 0 1-1.18 3.3 3.97 3.97 0 0 1-2.48 1.17 4 4 0 0 1-3.3-1.18 3.97 3.97 0 0 1-1.17-2.48 4.01 4.01 0 0 1 .7-2.72c.22-.35.7-.83 1.06-1.06a4.28 4.28 0 0 1 2.78-.69Zm-11.32 1.2a.7.7 0 0 0-.22.18.57.57 0 0 0-.09.34c0 .16.03.24.1.34.15.22.27.24 1.06.24s.9-.02 1.06-.24c.07-.1.09-.18.09-.34 0-.16-.02-.25-.09-.34-.16-.22-.27-.25-1.07-.25-.58 0-.74.02-.84.07Zm10.58 0a.71.71 0 0 0-.21.18c-.09.12-.09.14-.09 1.51s0 1.39.09 1.51c.17.24.21.25 1.65.25 1.43 0 1.48 0 1.65-.25.06-.1.09-.18.09-.34a.52.52 0 0 0-.09-.33c-.17-.24-.25-.25-1.3-.25h-.94v-.95c0-1.04-.01-1.13-.24-1.29a.67.67 0 0 0-.6-.05ZM3.88 14.2a.7.7 0 0 0-.22.19c-.06.09-.09.17-.09.33s.03.25.1.34c.15.22.27.25 1.06.25s.9-.03 1.06-.25c.07-.1.09-.18.09-.34 0-.16-.02-.24-.09-.33-.16-.23-.27-.25-1.07-.25-.58 0-.74.01-.84.06Z"
                                  ></path></svg></span
                              >
                                    <time>{{ $my_service->date_normal }}</time>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-y-3 gap-x-[7%]">
                                <button
                                    data-hk="0-0-0-0-1-11-5-0-0-1-3-0-0"
                                    class="button relative inline-flex cursor-pointer items-center justify-center text-center align-middle transition px-4 bg-primary-500 text-white hover:bg-primary-400 active:bg-primary-600 min-h-[45px] py-1 px-5 text-base rounded"
                                    type="button"
                                >
                                    Записаться на прием
                                </button
                                >
                                <button
                                    type="button"
                                    class="flex items-center whitespace-nowrap px-4 py-2 transition-[color] hover:text-primary-600 [.expanded_&amp;]:hidden"
                                    onclick="this.closest('article').classList.toggle('expanded')"
                                >
                                    Подробнее
                                    <svg
                                        viewBox="0 0 13 8"
                                        class="relative top-px ml-1.5 h-2 fill-current"
                                    >
                                        <path
                                            d="m1.42.06-1.1 1.1L6.5 7.35l6.19-6.19-1.1-1.1L6.5 5.14 1.42.06Z"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tabs hidden sm:pt-4 [.expanded_&amp;]:block">
                        <div role="tablist" class="flex flex-wrap justify-around">
                            <button
                                type="button"
                                role="tab"
                                class="active relative min-w-min max-w-40 border-b border-primary-500 py-3 px-4 text-center text-primary-500/50 transition hover:text-primary-500 sm:max-w-none sm:grow [&amp;.active]:text-primary-500"
                            >
                                Описание<span
                                    class="absolute inset-x-0 bottom-0 mb-[-3px] hidden h-[5px] rounded-full bg-primary-500 [.active>&amp;]:block"
                                ></span></button
                            >
                            <button
                                type="button"
                                role="tab"
                                class="relative min-w-min max-w-40 border-b border-primary-500 py-3 px-4 text-center text-primary-500/50 transition hover:text-primary-500 sm:max-w-none sm:grow [&amp;.active]:text-primary-500"
                            >
                                Показания<span
                                    class="absolute inset-x-0 bottom-0 mb-[-3px] hidden h-[5px] rounded-full bg-primary-500 [.active>&amp;]:block"
                                ></span></button
                            >
                            <button
                                type="button"
                                role="tab"
                                class="relative min-w-min max-w-40 border-b border-primary-500 py-3 px-4 text-center text-primary-500/50 transition hover:text-primary-500 sm:max-w-none sm:grow [&amp;.active]:text-primary-500"
                            >
                                Ограничения<span
                                    class="absolute inset-x-0 bottom-0 mb-[-3px] hidden h-[5px] rounded-full bg-primary-500 [.active>&amp;]:block"
                                ></span></button
                            >
                            <button
                                type="button"
                                role="tab"
                                class="relative min-w-min max-w-40 border-b border-primary-500 py-3 px-4 text-center text-primary-500/50 transition hover:text-primary-500 sm:max-w-none sm:grow [&amp;.active]:text-primary-500"
                            >
                                Результат<span
                                    class="absolute inset-x-0 bottom-0 mb-[-3px] hidden h-[5px] rounded-full bg-primary-500 [.active>&amp;]:block"
                                ></span>
                            </button>
                        </div>
                        <div class="[&amp;_p]:font-light [&amp;_p:not(:last-of-type)]:mb-4">
                            <div role="tabpanel" class="px-5 pt-5 pb-6">
                                <p>
                                    Кстати, активно развивающиеся страны третьего мира формируют
                                    глобальную экономическую сеть и при этом — разоблачены.
                                </p>
                                <p>
                                    Таким образом, реализация намеченных плановых заданий влечет за собой
                                    процесс внедрения и модернизации поставленных обществом задач. Сложно
                                    сказать, почему элементы политического процесса формируют глобальную
                                    экономическую сеть и при этом — подвергнуты целой серии независимых
                                    исследований.
                                </p>
                                <p>
                                    Принимая во внимание показатели успешности, начало повседневной работы
                                    по формированию позиции, а также свежий взгляд на привычные вещи —
                                    безусловно открывает новые горизонты для направлений прогрессивного
                                    развития.
                                </p>
                                <p>
                                    Наше дело не так однозначно, как может показаться: сложившаяся
                                    структура организации предполагает независимые способы реализации
                                    дальнейших направлений развития. Внезапно, предприниматели в сети
                                    интернет и по сей день остаются уделом либералов, которые жаждут быть
                                    обнародованы.
                                </p>
                                <p>
                                    В своём стремлении повысить качество жизни, они забывают, что граница
                                    обучения кадров однозначно фиксирует необходимость модели развития.
                                    Как уже неоднократно упомянуто, многие известные личности.
                                </p>
                                <div class="mt-7 flex flex-wrap gap-x-3 gap-y-4">
                                    <div class="grow"></div>
                                    <button
                                        type="button"
                                        class="flex items-center whitespace-nowrap px-4 py-2 transition-[color] hover:text-primary-600"
                                        onclick="this.closest('article').classList.toggle('expanded')"
                                    >
                                        Свернуть описание
                                        <svg
                                            viewBox="0 0 13 8"
                                            class="relative top-px ml-1.5 h-2 rotate-180 fill-current"
                                        >
                                            <path
                                                d="m1.42.06-1.1 1.1L6.5 7.35l6.19-6.19-1.1-1.1L6.5 5.14 1.42.06Z"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div role="tabpanel" class="hidden px-5 pt-5 pb-6">
                                <p>
                                    Кстати, активно развивающиеся страны третьего мира формируют
                                    глобальную экономическую сеть и при этом — разоблачены.
                                </p>
                                <p>
                                    Таким образом, реализация намеченных плановых заданий влечет за собой
                                    процесс внедрения и модернизации поставленных обществом задач. Сложно
                                    сказать, почему элементы политического процесса формируют глобальную
                                    экономическую сеть и при этом — подвергнуты целой серии независимых
                                    исследований.
                                </p>
                                <p>
                                    Принимая во внимание показатели успешности, начало повседневной работы
                                    по формированию позиции, а также свежий взгляд на привычные вещи —
                                    безусловно открывает новые горизонты для направлений прогрессивного
                                    развития.
                                </p>
                                <p>
                                    Наше дело не так однозначно, как может показаться: сложившаяся
                                    структура организации предполагает независимые способы реализации
                                    дальнейших направлений развития. Внезапно, предприниматели в сети
                                    интернет и по сей день остаются уделом либералов, которые жаждут быть
                                    обнародованы.
                                </p>
                                <p>
                                    В своём стремлении повысить качество жизни, они забывают, что граница
                                    обучения кадров однозначно фиксирует необходимость модели развития.
                                    Как уже неоднократно упомянуто, многие известные личности.
                                </p>
                                <div class="mt-7 flex flex-wrap gap-x-3 gap-y-4">
                                    <div class="grow"></div>
                                    <button
                                        type="button"
                                        class="flex items-center whitespace-nowrap px-4 py-2 transition-[color] hover:text-primary-600"
                                        onclick="this.closest('article').classList.toggle('expanded')"
                                    >
                                        Свернуть описание
                                        <svg
                                            viewBox="0 0 13 8"
                                            class="relative top-px ml-1.5 h-2 rotate-180 fill-current"
                                        >
                                            <path
                                                d="m1.42.06-1.1 1.1L6.5 7.35l6.19-6.19-1.1-1.1L6.5 5.14 1.42.06Z"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div role="tabpanel" class="hidden px-5 pt-5 pb-6">
                                <p>
                                    Кстати, активно развивающиеся страны третьего мира формируют
                                    глобальную экономическую сеть и при этом — разоблачены.
                                </p>
                                <p>
                                    Таким образом, реализация намеченных плановых заданий влечет за собой
                                    процесс внедрения и модернизации поставленных обществом задач. Сложно
                                    сказать, почему элементы политического процесса формируют глобальную
                                    экономическую сеть и при этом — подвергнуты целой серии независимых
                                    исследований.
                                </p>
                                <p>
                                    Принимая во внимание показатели успешности, начало повседневной работы
                                    по формированию позиции, а также свежий взгляд на привычные вещи —
                                    безусловно открывает новые горизонты для направлений прогрессивного
                                    развития.
                                </p>
                                <p>
                                    Наше дело не так однозначно, как может показаться: сложившаяся
                                    структура организации предполагает независимые способы реализации
                                    дальнейших направлений развития. Внезапно, предприниматели в сети
                                    интернет и по сей день остаются уделом либералов, которые жаждут быть
                                    обнародованы.
                                </p>
                                <p>
                                    В своём стремлении повысить качество жизни, они забывают, что граница
                                    обучения кадров однозначно фиксирует необходимость модели развития.
                                    Как уже неоднократно упомянуто, многие известные личности.
                                </p>
                                <div class="mt-7 flex flex-wrap gap-x-3 gap-y-4">
                                    <div class="grow"></div>
                                    <button
                                        type="button"
                                        class="flex items-center whitespace-nowrap px-4 py-2 transition-[color] hover:text-primary-600"
                                        onclick="this.closest('article').classList.toggle('expanded')"
                                    >
                                        Свернуть описание
                                        <svg
                                            viewBox="0 0 13 8"
                                            class="relative top-px ml-1.5 h-2 rotate-180 fill-current"
                                        >
                                            <path
                                                d="m1.42.06-1.1 1.1L6.5 7.35l6.19-6.19-1.1-1.1L6.5 5.14 1.42.06Z"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div role="tabpanel" class="hidden px-5 pt-5 pb-6">
                                <p>
                                    Кстати, активно развивающиеся страны третьего мира формируют
                                    глобальную экономическую сеть и при этом — разоблачены.
                                </p>
                                <p>
                                    Таким образом, реализация намеченных плановых заданий влечет за собой
                                    процесс внедрения и модернизации поставленных обществом задач. Сложно
                                    сказать, почему элементы политического процесса формируют глобальную
                                    экономическую сеть и при этом — подвергнуты целой серии независимых
                                    исследований.
                                </p>
                                <p>
                                    Принимая во внимание показатели успешности, начало повседневной работы
                                    по формированию позиции, а также свежий взгляд на привычные вещи —
                                    безусловно открывает новые горизонты для направлений прогрессивного
                                    развития.
                                </p>
                                <p>
                                    Наше дело не так однозначно, как может показаться: сложившаяся
                                    структура организации предполагает независимые способы реализации
                                    дальнейших направлений развития. Внезапно, предприниматели в сети
                                    интернет и по сей день остаются уделом либералов, которые жаждут быть
                                    обнародованы.
                                </p>
                                <p>
                                    В своём стремлении повысить качество жизни, они забывают, что граница
                                    обучения кадров однозначно фиксирует необходимость модели развития.
                                    Как уже неоднократно упомянуто, многие известные личности.
                                </p>
                                <div class="mt-7 flex flex-wrap gap-x-3 gap-y-4">
                                    <a
                                        data-hk="0-0-0-0-1-11-5-0-0-1-8-0-0"
                                        class="button relative inline-flex cursor-pointer items-center justify-center text-center align-middle transition px-7 text-primary-500 hover:bg-primary-500 hover:text-white border border-primary-500 active:bg-primary-600 active:text-white active:border-primary-600 min-h-[45px] py-1 px-5 text-base rounded"
                                        href="#"
                                    >Скачать результат</a
                                    >
                                    <div class="grow"></div>
                                    <button
                                        type="button"
                                        class="flex items-center whitespace-nowrap px-4 py-2 transition-[color] hover:text-primary-600"
                                        onclick="this.closest('article').classList.toggle('expanded')"
                                    >
                                        Свернуть описание
                                        <svg
                                            viewBox="0 0 13 8"
                                            class="relative top-px ml-1.5 h-2 rotate-180 fill-current"
                                        >
                                            <path
                                                d="m1.42.06-1.1 1.1L6.5 7.35l6.19-6.19-1.1-1.1L6.5 5.14 1.42.06Z"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        {{ $my_services->appends(['date' => isset($_GET['date']) ? $_GET['date'] : 'latest'])->links() }}
    </section>
@endsection
