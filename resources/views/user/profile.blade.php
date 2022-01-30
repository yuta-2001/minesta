<x-app-layout>

<section class="text-gray-600 body-font">
  
  <div class="container px-5 py-24 mx-auto">
    <div class="w-2/3 text-center mx-auto rounded">
      <x-flash-message status="session('status)" />
    </div>
    <div class="flex items-center lg:w-3/5 mx-auto pb-5 mb-2 sm:mb-5 sm:flex-row flex-col w-11/12">
      {{-- <div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center rounded-full justify-center bg-indigo-100 text-indigo-500 flex-shrink-0"> --}}
        <img class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center rounded-full justify-center bg-indigo-100 text-indigo-500 flex-shrink-0" src="{{ asset('storage/image/users/' . $user->profile_photo) }}">
      {{-- </div> --}}
      <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
        <h2 class="text-gray-900 text-lg title-font font-bold mb-2">{{ $user->name }}</h2>
        <p class="leading-relaxed text-base whitespace-pre-wrap">{{ $user->profile_comment }}</p>
        @if($user->id === Auth::id())
        <div class="cursor-pointer mt-4 flex justify-between mx-auto sm:justify-start">
          <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="text-white text-center py-2 px-3 sm:text-xs lg:text-base bg-blue-500 rounded hover:bg-blue-600 cursor-pointer w-auto sm:mr-4">プロフィール編集</a>
          <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method='post' class="text-white text-center  py-2 px-3 sm:text-xs lg:text-base bg-red-500 rounded hover:bg-red-600 cursor-pointer w-auto">
            @csrf
            @method('delete')
            <button type="submit" onclick='return confirm("削除しますか？");'>アカウントを削除</button>
          </form>
        </div>
        @endif
      </div>
    </div>
    <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
      <div class="flex-grow text-center mt-6 sm:mt-0">
        <h2 class="text-gray-900 text-lg title-font font-medium mb-2">投稿一覧</h2>
      </div>
    </div>
    <div class="px-5 py-5 mx-auto">
      <div class="flex flex-wrap -m-4 w-full">

        @foreach($posts as $post)

        <div class="p-1 w-full lg:w-1/3 sm:w-1/2">
          <div class="w-full border-2 border-gray-200 border-opacity-60 rounded-lg mx-auto flex  items-center justify-center flex-col mb-5 px-2 py-2">
            <div class="w-full flex justify-between sm:py-4 sm:px-6 items-center mb-2 sm:mb-0">
                <div class="ml-2 sm:ml-0">
                    <img class="sm:w-15 sm:h-15 h-10 w-10 mr-1 sm:mr-2 inline-flex items-center rounded-full justify-center bg-indigo-100 text-indigo-500 flex-shrink-0" src="{{ asset('storage/image/users/' . $post->user->profile_photo) }}">
                    <a href="{{ route('users.show', ['user' => $post->user_id]) }}" class="hover:text-blue-400">{{ $post->user->name }}</a>
                </div>
                @if($post->user->id === Auth::id())
                <div class="ml-auto w-30 sm:w-35 flex items-center">
                    <a class="mr-1 sm:mr-2 text-white text-center py-2 px-3 sm:text-xs lg:text-base bg-blue-500 rounded hover:bg-blue-600 hover:cursor-pointer w-auto" href="{{ route('posts.edit', ['post' => $post->id]) }}">編集</a>
                    {{-- <a href="{{ route('posts.destroy', ['post' => $post->id]) }}" class="w-2/5"><img src="{{ asset('image/parts9.png') }}"></a>
                        --}}
                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post" class="w-auto">
                        @csrf
                        @method('delete')
                        <div class="w-12 h-12 inline-flex items-center justify-center flex-shrink-0">
                            <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'><img src="{{ asset('image/trashbin.png') }}" class="w-full"></button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
            <img class="mb-5 object-cover object-center rounded w-full" alt="hero" src="{{ asset('storage/image/posts/' . $post->post_photo) }}">
            <div class="mb-5 w-full">
                <div class="flex items-center">
                    {{-- <form action="{{ route('likes.store', ['post_id' => $post->id]) }}" method="post" class="inline-flex" >
                        @csrf
                        @if($post->likedBy(Auth::user())->count() > 0)
                        <a href="{{ route('likes.destroy', ['post_id' => $post->id]) }}"><img class="w-8 h-8 sm:w-14 sm:h-14" src="{{ asset('image/heart_pink.png') }}"></a>
                        @else
                        <a href="{{ route('likes.store', ['post_id' => $post->id]) }}"><img class="w-7 h-7 sm:w-12 sm:h-12" src="{{ asset('image/heart.png') }}"></a>
                        @endif
                    </form> --}}
                    <div class="inline-flex">
                      @if($like_model->like_exist(Auth::id(),$post->id))
                          <p class="favorite-marke">
                          <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a>
                          <span class="likesCount">{{$post->likes_count}}</span>
                          </p>
                          @else
                          <p class="favorite-marke">
                          <a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a>
                          <span class="likesCount">{{$post->likes_count}}</span>
                          </p>
                      @endif
                    </div>

                    <div class="">
                        <label for="comment"><img class="w-9 h-9 sm:w-14 sm:h-14" src="{{ asset('image/comment.png') }}"></label>
                    </div>
                </div>
              </div>
                <div class="text-center w-11/12 mx-auto mb-3">
                  <p class="mb-8 leading-relaxed whitespace-pre-wrap">{{ $post->caption }}</p>
                  <div class="text-xs">
                      <p class="leading-relaxed">撮影場所：{{ $post->location }}</p>
                      <p class="leading-relaxed">投稿日時：{{ $post->created_at }}</p>
                  </div>
                </div>
                <div class="w-11/12 lg:w-2/3 mx-auto border-t-2 border-gray-200 py-6 px-5">
                  <p>コメント一覧</p>
                  @foreach($post->comments as $comment)
                  <div class="items-center flex justify-between mb-2">
                      <p class="w-10/12"><span class="font-bold">{{ $comment->user->name }}</span>：{{ $comment->content }}</p>
                      @if($post->user_id === Auth::id() || $comment->user->id === Auth::id())
                      <form action="{{ route('comments.destroy', ['comment_id' => $comment->id]) }}" class="inline-flex" method="POST">
                          @csrf
                          @method('delete')
                          <button class="py-1 px-1 bg-gray-500 rounded hover:bg-gray-600 hover:cursor-pointer text-xs text-white" type="submit">削除</button>
                      </form>
                      @endif
                  </div>
                  @endforeach
                </div>
                <form class="w-11/12 flex mx-auto border-t-2 border-gray-200 py-6 px-5" action="{{ route('comments.store', ['post_id' => $post->id]) }}" method="POST">
                    @csrf
                    <input class="border-none block w-full mx-auto hover:border-indigo-600" type="text" name="content" placeholder="コメントを入力">
                </form>
          </div>
        </div>
        @endforeach
      </div>
    </div>

  </div>
</section>
  
</x-app-layout>
