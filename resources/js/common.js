export default{
  data(){
    return {

    }
  },
  methods: {

    async callApi(method, url, dataObj){
      try {
        return await axios({
          method: method,
          url: url,
          data: dataObj
        });
      } catch (e){
        console.log(e)
        return e.response
      }
    },
    errorAlert(desc) {
        console.log(this.desc);
    }
    /*
    ,

    i(desc, title="Hey") {
        this.$Notice.info({
            title: title,
            desc: desc
        });
    },
    s(desc, title="Great!") {
        this.$Notice.success({
            title: title,
            desc: desc
        });
    },
    w(desc, title="Ooops!") {
        this.$Notice.warning({
            title: title,
            desc: desc
        });
    },
    e(desc, title="Ooops!") {
        this.$Notice.error({
            title: title,
            desc: desc
        });
    },
    swr(desc='something went wrong! please try again', title="Ooops") {
        this.$Notice.error({
            title: title,
            desc: desc
        });
    }
    */
  }
}