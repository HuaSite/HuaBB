<div class="sticky top-0">
    <div class="sticky mockup-window border bg-base-300 animate__animated animate__slideInDown"
        x-show="replyshow">
        <button class="absolute w-3 h-3 top-5 rounded-full bg-red-600 hover:bg-red-800" style="left: 1.40625rem"
            @click="replyshow = false">
            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" class="m-auto w-1.5 h-1.5"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                xml:space="preserve">
                <style type="text/css">
                    .st0 {
                        fill: rgb(255, 255, 255);
                    }
                </style>
                <g>
                    <polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465 
                    52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"
                        style="fill: rgb(255, 255, 255);"></polygon>
                </g>
            </svg>
        </button>
        <div class="overflow-y-auto max-h-96">
            <div class="flex justify-center px-4 py-16 bg-base-200">
                <div class="bg-stone-50 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-stone-50 border-b border-gray-200">
                        <div class="col-10 col-md-6 offset-1 offset-md-3">
                            <article class="prose max-w-none">
                                <form action="{{ route('replystore') }}" method="post" name="ansform"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <p>
                                    <h3>返信するID</h3>
                                    <input type="text" class="input input-bordered block mt-1 w-full max-w-xs"
                                        name="post_id" value="{{ $post->id }}" readonly />
                                    <input type="text" class="input input-bordered block mt-1 w-full max-w-xs"
                                        name="reply_user_id" value="{{ $post->user_idname }}" readonly />
                                    </p>
                                    <h3>本文</h3>
                                    <textarea id="huabbbody" name="body"></textarea>
                                    <h3>ファイル</h3>
                                    <div class="non-prose">
                                        <input type="file" class="input" name="file" id="file">
                                        <input type="button" class="btn" value="ファイルをクリア" onclick="test();">
                                        <script>
                                            function test(){
                                            var obj = document.getElementById("file");
                                            obj.value = "";
                                        }
                                        </script>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn">返信する
                                        </button>
                                    </div>
                                </form>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>