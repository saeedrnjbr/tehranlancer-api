<div class="flex items-center space-x-2">
    @if (!empty($editLink))
        <a href="{{ $editLink }}" class="inline-flex rounded-full bg-indigo-50 text-primary text-indigo-600 py-1 px-3 text-sm font-medium">
            ویرایش
        </a>
    @endif
    @if (!empty($removeLink))
        <a href="{{ $removeLink }}" class="inline-flex rounded-full bg-red-50 text-red py-1 px-3 text-sm font-medium">
            حذف
        </a>
    @endif
</div>
