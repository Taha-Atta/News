<x-mail::message>


Thank you {{$Name}}
    to subscrib !!!!!
{{$FamailyName}}

<x-mail::button :url="route('frontend.index')">
Visit News site
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
