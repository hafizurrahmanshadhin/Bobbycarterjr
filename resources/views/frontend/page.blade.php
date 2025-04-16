<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $dynamicPage->page_title }}</title>
</head>

<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="py-5 my-5 col-12">
                    <div class="card">
                        <p class="mt-4 lead">{!! $dynamicPage->page_content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
