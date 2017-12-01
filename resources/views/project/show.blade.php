@include('includes.header')
<body>
    <section class="project">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title"><i class="fa fa-laptop" aria-hidden="true"></i> {{ $data['project']->title }}</div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="about">
                            {{ $data['project']->about }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="logo">
                            <img src="{{ url('/') }}/project/logo/{{ $data['project']->id }}">
                        </div>
                        <div class="team">
                            <div class="title"><i class="fa fa-users" aria-hidden="true"></i> فريق العمل</div>
                            @foreach ($data['project']['team'] as $i)
                            <div class="man">
                                <a href="/{{ $i->username }}"><table>
                                    <tr>
                                        <td class="img">
                                            <img src="http://www.komicho.com/avatar/{{ $i->username }}">
                                        </td>
                                        <td>
                                            <h2>{{ $i->username }}</h2>
                                        </td>
                                    </tr>
                                </table></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')