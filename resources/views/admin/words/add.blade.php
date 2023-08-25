@extends('admin.layouts.admin-layout')

@section('title', 'Add Term')

@section('words_add_active', 'active')

@section('content')
<h3 class="mb-5">
    Add Term
</h3>
<style>
    .toolbar button {
        font-size: 22px;
        font-weight: bold
    }
</style>
<div class="card" id="add_cat">
    <div class="card-body">
        <div>
            <div class="d-flex justify-content-between gap-4">
                <div class="w-50 mb-3">
                    <label for="term_name" class="form-label">Term Name in English (for database only) *</label>
                    <input type="text" class="form-control" id="term_name" v-model="main_name">
                </div>
                <!-- Swiper -->
                <div class="swiper mySwiper w-50 mb-3 pb-5">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" v-for="(language, index) in languages_data" :key="index">
                            <div>
                                <label for="term_trans" class="form-label">Tearm in @{{language.name}} *</label>
                                <input type="text" class="form-control" id="term_trans" v-model="term_translations[language.symbol]">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 6l6 6l-6 6"></path>
                        </svg>
                    </div>
                    <div class="swiper-button-prev btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M15 6l-6 6l6 6"></path>
                        </svg>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <!-- Swiper -->
            <div class="swiper mySwiper w-100 mb-4 pb-5">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="(language, index) in languages_data" :key="index">
                        <div>
                            <label for="term_title" class="form-label">Title in @{{language.name}} *</label>
                            <input type="text" class="form-control" id="term_title" v-model="title_translations[language.symbol]">
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 6l6 6l-6 6"></path>
                    </svg>
                </div>
                <div class="swiper-button-prev btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 6l-6 6l6 6"></path>
                    </svg>
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <!-- Swiper -->
            <div class="swiper mySwiper w-100 mb-4 pb-3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide p-3" v-for="(language, index) in languages_data" :key="index">
                        <div>
                            <label for="lang_name" class="form-label">Content in @{{language.name}} *</label>
                            <div class="card">
                                <div class="card-header">
                                    <div class="toolbar d-flex gap-2 justify-content-center">
                                        <button @click="execCommand('bold')" class="btn btn-success"><b>B</b></button>
                                        <button @click="execCommand('italic')" class="btn btn-success"><i>I</i></button>
                                        <button @click="execCommand('underline')" class="btn btn-success"><u>U</u></button>
                                        <button @click="execCommand('insertOrderedList')" class="btn btn-success"><i class="ti ti-list-numbers"></i></button>
                                        <button @click="execCommand('insertUnorderedList')" class="btn btn-success"><i class="ti ti-list"></i></button>
                                        <button @click="execCommand('justifyLeft')" class="btn btn-success"><i class="ti ti-align-left"></i></button>
                                        <button @click="execCommand('justifyCenter')" class="btn btn-success"><i class="ti ti-align-center"></i></button>
                                        <button @click="execCommand('justifyRight')" class="btn btn-success"><i class="ti ti-align-right"></i></button>
                                        <button @click="insertHTML('<h2>Heading</h2>', 'article-content-' + language.symbol)" class="btn btn-success"><i class="ti ti-h-2"></i></button>
                                        <button @click="insertHTML('<h3>Heading</h3>', 'article-content-' + language.symbol)" class="btn btn-success"><i class="ti ti-h-3"></i></button>
                                        <button @click="insertHTML('<h4>Heading</h4>', 'article-content-' + language.symbol)" class="btn btn-success"><i class="ti ti-h-4"></i></button>
                                        <button @click="insertHTML('<h5>Heading</h5>', 'article-content-' + language.symbol)" class="btn btn-success"><i class="ti ti-h-5"></i></button>
                                        <button @click="insertHTML('<h6>Heading</h6>', 'article-content-' + language.symbol)" class="btn btn-success"><i class="ti ti-h-6"></i></button>
                                        <button @click="insertHTML('<p>Paragraph</p>', 'article-content-' + language.symbol)" class="btn btn-success">P</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div contenteditable="true" :id="'article-content-' + language.symbol" class="form-control" style="min-height: 300px" @changes="contentChanges(language.symbol)"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 6l6 6l-6 6"></path>
                    </svg>
                </div>
                <div class="swiper-button-prev btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 6l-6 6l6 6"></path>
                    </svg>
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="mb-3 w-100 d-flex gap-3">
                <div class="w-25">
                    <label for="thumbnail" class="w-100 h-100 p-3 d-flex justify-content-center align-items-center form-control" style="max-height: 170px;">
                        <img src="{{asset('dashboard/images/add_image.svg')}}" id="preview" alt="img logo" style="width: 100%; max-width: 100%;object-fit: contain;height: 100%;">                                                
                    </label>
                    <input type="file" name="thumbnail" id="thumbnail" class="d-none" @change="photoChanges">
                </div>
                <div class="w-75">
                    <div class="w-100 mb-3 d-flex gap-3">
                        <div class="w-100" v-if="categories_data">
                            <label for="symbol" class="form-label">Category *</label>
                            <select name="cat_type" id="cat_type" class="form-control" v-model="cat_id" @change="prevSubCat()">
                                <option v-for="(category, index) in categories_data" :key="index" :value="category.id" v-if="categories_data.length > 0">
                                    @{{category.main_name}}
                                </option>
                            </select>
                        </div>

                        <div class="w-100" v-if="show_sub_categories">
                            <label for="symbol" class="form-label">Sub Category *</label>
                            <select name="cat_type" id="cat_type" class="form-control" v-model="cat_id" @change="prevSubCat()">
                                <option v-for="(category, index) in sub_categories_data" :key="index" :value="category.id" v-if="categories_data.length > 0">
                                    @{{category.main_name}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <!-- Swiper -->
                    <div class="swiper mySwiper w-100 mb-3 pb-5">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="(language, index) in languages_data" :key="index">
                                <div>
                                    <label for="sound_iframe" class="form-label">Sound in @{{language.name}} (iframe)</label>
                                    <input type="text" class="form-control" id="sound_iframe" v-model="sounds_translations[language.symbol]">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 6l6 6l-6 6"></path>
                            </svg>
                        </div>
                        <div class="swiper-button-prev btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 6l-6 6l6 6"></path>
                            </svg>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

            <div  class="d-flex justify-content-between gap-4 align-items-end flex-wrap-wrap">
                <div class="w-50">
                </div>
                <button type="submit" class="btn btn-primary w-50 form-control" style="height: fit-content" @click="getContentTranslations().then(() => { add(main_name, term_translations, title_translations, content_translations, thumbnail, sounds_translations, cat_id)})"><i class="ti ti-plus"></i> Add</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('/libs/swiper.css') }}">
<style>
    .swiper-button-next, .swiper-button-prev {
        width: fit-content !important;
        height: fit-content !important;
        padding: 4px !important;
        display: flex !important;
        bottom: 0 !important;
        top: auto;
        z-index: 9999;
    }
    .swiper-pagination {
        bottom: 0
    }
    .swiper-button-next::after, .swiper-button-prev::after {
        content: ""
    }
</style>
@endsection

@section('scripts')
<!-- Swiper JS -->
<script src="{{ asset('/libs/swiper.js') }}"></script>

<!-- Initialize Swiper -->
<script>
window.onload = function() {
    var swiper = new Swiper(".mySwiper", {
      pagination: {
        el: ".swiper-pagination",
        type: "fraction",
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
};
</script>

<script>
const { createApp, ref } = Vue;

createApp({
  data() {
    return {
      main_name: null,
      cat_id: null,
      languages_data: null,
      categories_data: null,
      sub_categories_data: null,
      thumbnail: null,
      term_translations: {},
      title_translations: {},
      content_translations: {},
      sounds_translations: {},
      show_sub_categories: false,
    }
  },
  methods: {
    async add(main_name, term_translations, title_translations, content_translations, thumbnail, sounds_translations, cat_id) {
      $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`/admin/words/add`, {
                main_name: main_name,
                term_translations: term_translations,
                title_translations: title_translations,
                content_translations: content_translations,
                thumbnail: thumbnail,
                sounds_translations: sounds_translations,
                cat_id: cat_id,
            },
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            );
            if (response.data.status === true) {
            document.getElementById('errors').innerHTML = ''
            let error = document.createElement('div')
            error.classList = 'success'
            error.innerHTML = response.data.message
            document.getElementById('errors').append(error)
            $('#errors').fadeIn('slow')
            $('.loader').fadeOut()
            setTimeout(() => {
                $('#errors').fadeOut('slow')
                window.location.href = '/admin/words'
            }, 1300);
            } else {
            $('.loader').fadeOut()
            document.getElementById('errors').innerHTML = ''
            $.each(response.data.errors, function (key, value) {
                let error = document.createElement('div')
                error.classList = 'error'
                error.innerHTML = value
                document.getElementById('errors').append(error)
            });
            $('#errors').fadeIn('slow')
            setTimeout(() => {
                $('input').css('outline', 'none')
                $('#errors').fadeOut('slow')
            }, 5000);
            }

        } catch (error) {
            document.getElementById('errors').innerHTML = ''
            let err = document.createElement('div')
            err.classList = 'error'
            err.innerHTML = 'server error try again later'
            document.getElementById('errors').append(err)
            $('#errors').fadeIn('slow')
            $('.loader').fadeOut()

            setTimeout(() => {
            $('#errors').fadeOut('slow')
            }, 3500);

            console.error(error);
        }
    },
    async getLanguages() {
        $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`/admin/words/get-languages`, {
            },
            );
            if (response.data.status === true) {
                $('.loader').fadeOut()
                this.languages_data = response.data.data
            } else {
                $('.loader').fadeOut()
                document.getElementById('errors').innerHTML = ''
                $.each(response.data.errors, function (key, value) {
                    let error = document.createElement('div')
                    error.classList = 'error'
                    error.innerHTML = value
                    document.getElementById('errors').append(error)
                });
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('input').css('outline', 'none')
                    $('#errors').fadeOut('slow')
                }, 5000);
            }

        } catch (error) {
            document.getElementById('errors').innerHTML = ''
            let err = document.createElement('div')
            err.classList = 'error'
            err.innerHTML = 'server error try again later'
            document.getElementById('errors').append(err)
            $('#errors').fadeIn('slow')
            $('.loader').fadeOut()
            this.languages_data = false
            setTimeout(() => {
                $('#errors').fadeOut('slow')
            }, 3500);

            console.error(error);
        }
    },
    async getCategories() {
        $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`/admin/categories/`, {
            },
            );
            if (response.data.status === true) {
                $('.loader').fadeOut()
                this.categories_data = response.data.data
            } else {
                $('.loader').fadeOut()
                document.getElementById('errors').innerHTML = ''
                $.each(response.data.errors, function (key, value) {
                    let error = document.createElement('div')
                    error.classList = 'error'
                    error.innerHTML = value
                    document.getElementById('errors').append(error)
                });
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('input').css('outline', 'none')
                    $('#errors').fadeOut('slow')
                }, 5000);
            }

        } catch (error) {
            document.getElementById('errors').innerHTML = ''
            let err = document.createElement('div')
            err.classList = 'error'
            err.innerHTML = 'server error try again later'
            document.getElementById('errors').append(err)
            $('#errors').fadeIn('slow')
            $('.loader').fadeOut()
            this.languages_data = false
            setTimeout(() => {
                $('#errors').fadeOut('slow')
            }, 3500);

            console.error(error);
        }
    },
    async getSubCategories() {
        $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`/admin/categories/sub`, {
                cat_id: this.cat_id
            },
            );
            if (response.data.status === true) {
                $('.loader').fadeOut()
                this.sub_categories_data = response.data.data
            } else {
                $('.loader').fadeOut()
                document.getElementById('errors').innerHTML = ''
                $.each(response.data.errors, function (key, value) {
                    let error = document.createElement('div')
                    error.classList = 'error'
                    error.innerHTML = value
                    document.getElementById('errors').append(error)
                });
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('input').css('outline', 'none')
                    $('#errors').fadeOut('slow')
                }, 5000);
            }

        } catch (error) {
            document.getElementById('errors').innerHTML = ''
            let err = document.createElement('div')
            err.classList = 'error'
            err.innerHTML = 'server error try again later'
            document.getElementById('errors').append(err)
            $('#errors').fadeIn('slow')
            $('.loader').fadeOut()
            this.languages_data = false
            setTimeout(() => {
                $('#errors').fadeOut('slow')
            }, 3500);

            console.error(error);
        }
    },
    pushCatTranslation(id, name) {
        this.category_translations.push({
            lang_id: id,
            name: name
        })
    },
    prevSubCat() {
        this.getSubCategories().then(() => {
            if (this.sub_categories_data.length) {
                this.show_sub_categories = true
            }
        })
    },
    execCommand(command) {
        document.execCommand(command, false, null);
    },
    insertHTML(html, element, key) {
        document.getElementById(element).focus();
        document.execCommand('insertHTML', false, html);
    },
    photoChanges(event) {
        this.thumbnail = event.target.files[0];
    },
    async getContentTranslations () {
        console.log(this.languages_data);
        await this.languages_data.forEach((language, index) => {
            if (document.getElementById('article-content-' + language.symbol) && document.getElementById('article-content-' + language.symbol).innerHTML != '')
                this.content_translations[language.symbol] = document.getElementById('article-content-' + language.symbol).innerHTML;
        })
    }

  },
  created() {
    this.getLanguages()
    this.getCategories()
  },
  mounted() {
    $("#thumbnail").change(function () {
        // check if file is valid image
        var file = this.files[0];
        var fileType = file.type;
        var validImageTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            document.getElementById("errors").innerHTML = "";
            let error = document.createElement("div");
            error.classList = "error";
            error.innerHTML =
                "Invalid file type. Please choose a GIF, JPEG, or PNG image.";
            document.getElementById("errors").append(error);
            $("#errors").fadeIn("slow");
            setTimeout(() => {
                $("#errors").fadeOut("slow");
            }, 2000);

            $(this).val(null);
            $("#preview").attr(
                "src",
                "/dashboard/images/add_image.svg"
            );
            $(".photo_group i").removeClass("fa-edit").addClass("fa-plus");
        } else {
            // display image preview
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#preview").attr("src", e.target.result);
                $(".photo_group  i")
                    .removeClass("fa-plus")
                    .addClass("fa-edit");
                $(".photo_group label >i").fadeOut("fast");
            };
            reader.readAsDataURL(file);
        }
    });
  },
}).mount('#add_cat')
</script>
@endsection