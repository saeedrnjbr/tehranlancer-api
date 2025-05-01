<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}">
    @vite(['resources/css/ui.css'])
</head>

<body>

    <div class="flex items-center justify-center bg-[#19C472] min-h-screen">

        <form method="post" action="{{ route('user.auth') }}" class='flex flex-col space-y-4  text-center'>

            @csrf


            <img class=" w-fit" src="https://tehranlancer.com/media/2023/06/logo_lancer_h-2-copy.png" />

            <h3 class='text-2xl font-semibold text-black'>برای استفاده از امکانات اپلیکیشن باید عضو لنسر بشی!</h3>

            <p class='text-base text-white'>لطفا شماره موبایل خود را وارد کنید</p>

            @include('partials.errors')

            @if (session()->has('success'))
                <div class=" bg-green-300 py-2 text-green-700">
                    {{ session()->get('success') }}
                </div>
            @endif

            <input name='mobile'
                class='rounded-xl bg-white border border-neutral-200 w-full text-left px-3 py-4 mt-2 placeholder-neutral-400 '
                placeholder='شماره موبایل' />

            <p class='text-right py-3 text-sm text-black'>ورود شما به معنای پذیرش <span
                    class='text-primary-green  font-semibold px-1'>قوانین</span> است.</p>

            <button type='submit'
                class=' btn-bg relative shadow-[3px_3px_3px_#098549]   cursor-pointer text-lg font-semibold mt-5 text-white rounded-full px-3 py-2 bg-neutral-800 '>
                <img class=' absolute right-2 top-2' src="/images/ellipse.png" />
                <img class=' absolute left-2 top-2' src="/images/vector.png" />
                <span>ثبت نام</span>
            </button>
        </form>
    </div>

</body>

</html>
