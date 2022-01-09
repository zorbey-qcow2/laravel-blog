<x-layout>
    <x-slot name="content">
        <section class="px-6 py-8">
            <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
                <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                    <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                        <img src="{{ asset('/storage/' . $post->thumbnail) }}" alt="" class="rounded-xl">

                        <p class="mt-4 block text-gray-400 text-xs">
                            <time>{{ $post->created_at->diffForHumans() }} yayınlandı</time>
                        </p>

                        <div class="flex items-center lg:justify-center text-sm mt-4">
                            <img src="{{   $post->author->avatar ? asset('/storage/' . $post->author->avatar) : '/storage/thumbnails/avatar.png' }}" alt="">
                            <div class="ml-3 text-left">
                                <h5 class="font-bold text-red-800">{{ $post->author->username }}</h5>
                                @if($post->author->epigram)
                                    <h6 class="text-gray-600">{{$post->author->epigram}}</h6>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-span-8">
                        <div class="hidden lg:flex justify-between mb-6">
                            <a href="/"
                               class="transition-colors duration-300 relative inline-flex items-center text-lg text-lime-100 hover:text-blue-500">
                                <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                    <g fill="none" fill-rule="evenodd">
                                        <path stroke="#000" stroke-opacity=".012" stroke-width=".5"
                                              d="M21 1v20.16H.84V1z">
                                        </path>
                                        <path class="fill-current"
                                              d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                        </path>
                                    </g>
                                </svg>

                                Ana sayfa
                            </a>

                            <div class="space-x-2">
                                <x-category-button :category="$post->category"/>
                            </div>
                        </div>

                        <h1 class="font-bold text-3xl lg:text-4xl mb-10 text-teal-700">
                            {{$post->title}}
                        </h1>

                        <div class="space-y-4 lg:text-lg leading-loose text-green-700">
                            {{$post->body}}
                        </div>
                        <div class="text-white text-right mt-2">
                            @include('like.like', ['model' => $post])
                        </div>
                        @if(count($post->imagepush) > 0)
                            <section class="col-span-8 col-start-5 mt-16 space-y-6">
                                @foreach($post->imagepush as $image)
                                    <div class="lg:text-lg leading-loose mt-10 text-red-900 border border-blue-300 p-2">
                                        Ek dosya:
                                        <div class="text-gray-400">Görsel: <a class="underline"
                                                                              href="{{$image->file_location}}">{{$image->excerpt}}</a>
                                        </div>
                                        <div class="text-blue-300">Görüntülenme: {{$image->view_count}}</div>
                                    </div>
                                @endforeach
                            </section>
                        @endif
                    </div>

                    <section class="col-span-8 col-start-5 mt-10 space-y-6">
                        <x-comment._add-comment-form :post="$post" commentposttitle="Katılım sağlayacak mısın?"/>
                        @foreach($comments->sortByDesc("created_at") as $comment)
                            <x-comment.post-comment :comment="$comment"/>
                        @endforeach

                        {{ $comments->links() }}
                    </section>
                </article>
            </main>
        </section>
    </x-slot>
</x-layout>


