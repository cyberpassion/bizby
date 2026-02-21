<style>
    @font-face {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 400;
        src: url('{{ public_path("fonts/Inter/Inter_24pt-Regular.ttf") }}') format('truetype');
    }

    @font-face {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 600;
        src: url('{{ public_path("fonts/Inter/Inter_24pt-SemiBold.ttf") }}') format('truetype');
    }

    body {
        font-family: 'Inter', sans-serif;
        font-size: 12px;
    }

    table {
        font-family: 'Inter', sans-serif;
        font-size: 11.75px;
        border-collapse: collapse;
    }

    th {
        font-weight: 600;
    }
</style>

@php
    $firstRow = $reportData->first();

    $allColumns = $firstRow
        ? array_keys($firstRow->getAttributes())
        : [];

    // Use provided columns if available, else fallback
    $visibleColumns = !empty($columns ?? null)
        ? $columns
        : $allColumns;
@endphp

<div style="width: 100%; margin-bottom: 10px;">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td style="text-align: left;">
                <h2 style="margin: 0; font-size: 16px;">
                    {{ $reportTitle ?? 'Report' }}
                </h2>
                <small>
                    Generated on: {{ now()->format('d M Y, h:i A') }}
                    by {{ config('app.name') }}
                </small>
            </td>
            <td style="text-align: right;">
                <strong>{{ $tenantName ?? 'Default Tenant' }}</strong><br>
                <small>{{ $tenantByline ?? '' }}</small>
            </td>
        </tr>
    </table>
</div>

<table width="100%" border="1" cellspacing="0" cellpadding="6">
    <thead>
        <tr>
            @foreach($visibleColumns as $column)
                <th style="border: 0.5px solid #000;">
                    {{ ucfirst(str_replace('_', ' ', $column)) }}
                </th>
            @endforeach
        </tr>
    </thead>

    <tbody>
        @forelse($reportData as $row)
            <tr>
                @foreach($visibleColumns as $column)
                    <td style="border: 0.5px solid #000;">
                        {{ $row->{$column} ?? '' }}
                    </td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($visibleColumns) ?: 1 }}"
                    style="text-align: center; border: 0.5px solid #000;">
                    No data available
                </td>
            </tr>
        @endforelse
    </tbody>
</table>