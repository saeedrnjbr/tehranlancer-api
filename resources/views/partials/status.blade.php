<div>
    @if ($status)
        <span class="inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium text-success">
            فعال
        </span>
    @endif
    @if (!$status)
        <span class="inline-flex rounded-full bg-red bg-opacity-10 py-1 px-3 text-sm font-medium text-red">
            غیرفعال
        </span>
    @endif
</div>
