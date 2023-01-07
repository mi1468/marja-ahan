<!-- MEEEEEEEEEEEEEEEEEEE -->
<template>
    <div  style="        display: flex;
    background: #fff;
    padding: 0 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    width:100%;">
    
    <div class="btn-group full-width force-center" style="    border-radius: 30px; border-color: green; max-width: none;">
        
        <div class="selectdiv" style="background: none;
        border: none !important;
        outline: none !important;
        padding: 0;
        transition: 0.3s;
        border-radius: 8px;">

            <select
            
                class="form-control fs13 styled-select"
                name="category"
                aria-label="Category"
                @change="focusInput($event)"
                style="     
                    border-radius: 8px;
                    background: #ffc801;
                    border: none;
                    height: 32px;
                    margin: 3px;
                    font-weight: bold;
                    width: 130px;
                "
            >
                <option value="" v-text="__('header.all-categories')"></option>

                <template
                    v-for="(category, index) in $root.sharedRootCategories"
                >
                    <option
                        :key="index"
                        selected="selected"
                        :value="category.id"
                        v-if="category.id == searchedQuery.category"
                        v-text="category.name"
                    >
                    </option>

                    <option
                        :key="index"
                        :value="category.id"
                        v-text="category.name"
                        v-else
                    ></option>
                </template>
            </select>

            <div class="select-icon-container d-inline-block float-right">
                <span class="select-icon rango-arrow-down"></span>
            </div>
        </div>
 
        <input

            required
            name="term"
            type="search"
            class="form-control"
            :placeholder="__('header.search-text')"
            aria-label="Search"
            v-model:value="inputVal"
            style="margin-right: 11px;  font-weight: bold;"
        />

        <!-- <slot name="image-search"></slot> -->

        <button
            class="btn"
            type="button"
            id="header-search-icon"
            aria-label="Search"
            @click="submitForm"
            style="background: none;"
        >
            <i class="fs16 fw6 rango-search"  style="color: #767676; font-size: 20px !important;"></i>
        </button>
    </div>      
    </div>
</template>

<script type="text/javascript">
export default {
    data: function() {
        return {
            inputVal: '',
            searchedQuery: []
        };
    },

    created: function() {
        let searchedItem = window.location.search.replace('?', '');
        searchedItem = searchedItem.split('&');

        let updatedSearchedCollection = {};

        searchedItem.forEach(item => {
            let splitedItem = item.split('=');
            updatedSearchedCollection[splitedItem[0]] = decodeURI(
                splitedItem[1]
            );
        });

        if (updatedSearchedCollection['image-search'] == 1) {
            updatedSearchedCollection.term = '';
        }

        this.searchedQuery = updatedSearchedCollection;

        if (this.searchedQuery.term) {
            this.inputVal = decodeURIComponent(
                this.searchedQuery.term.split('+').join(' ')
            );
        }
    },

    methods: {
        focusInput: function(event) {
            $(event.target.parentElement.parentElement)
                .find('input')
                .focus();
        },

        submitForm: function() {
            if (this.inputVal !== '') {
                $('input[name=term]').val(this.inputVal);
                $('#search-form').submit();
            }
        }
    }
};
</script>
