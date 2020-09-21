<template>
  <div id="topContents">
    <div id="topFormWrap">
      <input v-model="keyword" type="text" placeholder="buscar en el diccionario / diccionario ra pliki saks">
      <button v-on:click="searchWord" type="submit"><img src="/miskito2/public/img/search.png" alt=""></button>
      <div id="topResultsArea">
        <p>{{ keyword }}</p>
        <ul>
          <li v-for="(words, i) in results" :key="i" v-if="results.length">
            <span id="searchedWord">
              <span v-for="(hitwordarry, k) in words.hitword" :key="k" v-if="words.hitword">
                【{{ hitwordarry.miskitoWord }}{{ hitwordarry.spanishWord }}】
              </span>
            </span>
            en {{  tarLan }}
            <ul id="wordsList">
              <li v-for="(meaning, j) in words.meanings" :key="j" v-if="words.meanings">
                <span v-on:click="showWordDetail(meaning.id)">{{meaning.spanishWord}}{{meaning.miskitoWord}}</span>

              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div id="topContentsArea">
        <About />
      </div>
    </div>
  </div>
</template>

<script>
  import About from './modules/about.vue'
  export default{
    components:{
      About
    },
    data(){
      return{
        keyword: "",
        results: "",
        hoge: "",
        tarLan: "español",
        link: "http://miskito.org",
        counter: ""
      }
    },
    methods:{
      increase: function(step, event){
        this.counter += step
      },
      showWordDetail: function(id){
        console.log(id)
      },
      // 検索
      async searchWord(){
        const data = {
          'keyword': this.keyword
        }
        const res = await this.callApi('post', '/miskito2/public/api/getSearchResult', data)
        if(res.status===200){
          this.results = res.data
        }else{
          console.log('something went wrong')
        }
        let hoge
        for(let i in this.results){

            hoge = this.results[i]
          
        }
        this.datLan = hoge.lang 
        if(this.datLan == "esp"){

          this.tarLan = "miskito"
        }
        this.About = false
      }
    }
  }
</script>