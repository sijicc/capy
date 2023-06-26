<table {{ $attributes->twMerge("w-full text-left text-sm text-gray-500 dark:text-gray-400") }}>
    <thead
        @class([
            "bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400",
        ])
    >
        <tr>
            {{ $head }}
        </tr>
    </thead>
    <tbody @class([
        "divide-y divide-gray-200 bg-white",
    ])>
        {{ $body }}
    </tbody>
</table>
