<table @class([
    'w-full table-auto',
])>
    <thead @class([
        'border-b border-gray-200 font-normal text-gray-500 text-left text-sm',
])>
    <tr>
        {{ $head }}
    </tr>
    </thead>
    <tbody @class([
        'bg-white divide-y divide-gray-200',
])>
    {{ $body }}
    </tbody>
</table>
