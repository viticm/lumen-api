@component('mail::message')
# 新的申请

这是一段你看不到的描述.

@component('mail::button', ['url' => $url])
申请
@endcomponent

@component('mail::table')
|		 |						|
| :----: | :------------------: |
|  名称  |      {{$name}}       |
|  年龄  |      {{$age }}       |
|  性别  |      {{$sex}}        |
|  身高  |      {{$height}}     |
|  体重  |      {{$weight}}     |
|  电话  |      {{$tel}}        |
|		 |						|
|		 |						|
|  描述  |   {{$description}}   |
|		 |						|
|		 |						|
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
