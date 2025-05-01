@extends('layouts.master')

@section('content')
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex flex-wrap items-center">
                    <div class="hidden w-full xl:block xl:w-1/2">
                        <div class="py-17.5 px-26 text-center">
                            <a class="mb-5.5 inline-block" href="/">
                                <img class="hidden dark:block" src="/images/logo.webp" alt="Logo" />
                                <img class="dark:hidden" src="/images/logo.webp" alt="Logo" />
                            </a>
                        </div>
                    </div>
                    <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                        <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                            <span class="mb-1.5 block font-medium">پنل مدیریت</span>
                            <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                                مرکز نوآوری لنسر شریف  
                            </h2>
                            <form method="post" action="{{ route("admin.auth") }}">
                                
                                @include("partials.errors")
                                @csrf

                                <div class="mb-4">
                                    <label
                                        class="mb-2.5 block font-medium text-black dark:text-white">تلفن همراه</label>
                                    <div class="relative">
                                        <input value="{{ @old("mobile") }}" type="text" name="mobile" class="w-full rounded-lg border border-stroke bg-transparent p-4 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />

                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label class="mb-2.5 block font-medium text-black dark:text-white">رمزعبور</label>
                                    <div class="relative">
                                        <input type="password" name="password"
                                            class="w-full rounded-lg border border-stroke bg-transparent p-4  outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <input type="submit" value="ورود"
                                        class="w-full cursor-pointer text-lg rounded-lg border border-primary bg-secondary p-4 font-medium transition hover:bg-opacity-90" />
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ====== Forms Section End -->
        </div>
    </main>
@endsection
