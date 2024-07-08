<a href="{{ url($url) }}" class="box" style="background: {{ $color }};">
    <span class="title">{{ $title }}</span>
    <span class="subtitle">{{ $subtitle }}</span>
</a>

@once
    <style>
        a.box {
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            padding: 10px;
            color: white;
            transition: .3s all;
        }

        a.box:hover {
            background: black !important;
            font-size: 110%;
            border: 2px solid white;
            border-radius: 10px;
        }

        .box .subtitle {
            font-size: 14px;
        }
        .box .title {
            font-size: 16px;
        }
    </style>
@endonce
