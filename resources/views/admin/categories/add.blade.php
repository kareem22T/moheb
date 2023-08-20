@extends('admin.layouts.admin-layout')

@section('title', 'Add Category')

@section('categories_add_active', 'active')

@section('content')
<h3 class="mb-5">
    Add category
</h3>
<div class="card" id="add_lang">
    <div class="card-body">
        <div>
            <div class="d-flex justify-content-between gap-4">
                <div class="w-50 mb-3">
                    <label for="symbol" class="form-label">Main Name in English (for database only)</label>
                    <input type="text" class="form-control" id="symbol" v-model="symbol">
                </div>
                  <!-- Swiper -->
                <div class="swiper mySwiper w-50 mb-3 pb-5">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" v-for="(language, index) in languages_data" :key="index">
                            <div>
                                <label for="lang_name" class="form-label">Name in @{{language.name}}</label>
                                <input type="text" class="form-control" id="lang_name" v-model="category_translations[language.symbol]">
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
            <div class="w-100 mb-3">
                <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Description" v-model="description"></textarea>
            </div>
            <div  class="d-flex justify-content-between gap-4 align-items-end">
                <div class="w-50">
                    <label for="symbol" class="form-label">Category Type</label>
                    <select name="cat_type" id="cat_type" class="form-control" @change="chooseCatType(this.cat_type)" v-model="cat_type">
                        <option value="" selected>----</option>
                        <option value="0">Main Category</option>
                        <option value="1">Sub Category</option>
                    </select>
                </div>
                <div class="w-50" v-if="show_main_categories">
                    <label for="symbol" class="form-label">Choos Main Category</label>
                    <select name="cat_type" id="cat_type" class="form-control" v-model="main_cat_id">
                        <option value="" selected>----</option>
                        <option v-for="(category, index) in categories_data" :key="index" :value="category.id">
                            @{{category.main_name}}
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-50 form-control" style="height: fit-content" @click="add(this.symbol, this.lang_name)"><i class="ti ti-plus"></i> Add</button>
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
      symbol: null,
      lang_name: null,
      languages_data: null,
      categories_data: null,
      category_translations: {},
      description: null,
      cat_type: null,
      show_main_categories: false,
    }
  },
  methods: {
    async add(symbol, lang_name) {
      $('.loader').fadeIn().css('display', 'flex')
      try {
        const response = await axios.post(`/admin/languages/add`, {
          symbol: symbol,
          name: lang_name,
        },
        );
        if (response.data.status === true) {
          document.getElementById('errors').innerHTML = ''
          let error = document.createElement('div')
          error.classList = 'success'
          error.innerHTML = response.data.message
          document.getElementById('errors').append(error)
          $('#errors').fadeIn('slow')
          setTimeout(() => {
            $('.loader').fadeOut()
            $('#errors').fadeOut('slow')
            window.location.href = '/admin/languages'
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
            const response = await axios.post(`/admin/categories/get-languages`, {
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
    pushCatTranslation(id, name) {
        this.category_translations.push({
            lang_id: id,
            name: name
        })
    },
    chooseCatType(cat_type) {
        if (cat_type == 1) {
            getCategories.then(()=> {
                this.show_main_categories = true
            })
        }
    }
  },
  created() {
    this.getLanguages()
  },
}).mount('#add_lang')
</script>
@endsection