<html>
<meta charset="UTF-8">
<body>
    <section style="width: auto; background: #f5f5f5; border-top: 5px solid #2ecc71; font-family: tahoma, sans-serif; text-align: center; direction: rtl; padding: 25px;">
        <h1 style="color:#34495e; text-align: center;">ترحب بك في <span style="color:#2ecc71;">دواير</span></h1>
        <p style="color:#34495e;"><b>دواير</b> هو تطبيق يعمل علي توفير منصة تواصل بين الشركات والمطورين و بين المطورين وبعضهم في مجتمع تقني يهدف إلي تواصل أفضل وأسرع ومصداقية في المعلومات.</p>
        <p style="color:#34495e;">مرحبا بك {{ $data['user']['first_name'] }} {{ $data['user']['last_name'] }}</p>
        <p style="color:#34495e;"><b>الوظائف المقترحة</b></p>
        
        @foreach ($data['jobs'] as $i)      
        <div style="background: #eee;text-align: right;padding: 17px 37px;     margin: 7px 0px;">
            <h2><a href="{{ url('/') }}/job/show/{{ $i->job_id }}" style="color: #2ecc71;">{{ $i->title }}</a></h2>
            <p>
                <span>الشركة: <a hraf="{{ url('/') }}/{{ $i->companie_url }}">{{ $i->companie }}</a></span>
            </p>
        </div>
        @endforeach
        
    </section>
</body>
</html>