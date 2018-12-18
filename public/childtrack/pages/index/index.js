// pages/index/index.js
var app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    is_modal_Hidden: false,
    is_modal_Msg: '我是一个自定义组件',
    slider: [],
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.getRecommenData()
    this.test()
  },

  test: function() {
    var params = {
    }
    app.api.Childtrack_getAlbumByid(params).then(res=>{
      console.log(res);
    });
  },

  getRecommenData: function () {
    const _that = this
    wx.request({
      url: "https://c.y.qq.com/musichall/fcgi-bin/fcg_yqqhomepagerecommend.fcg?g_tk=5381&inCharset=utf-8&outCharset=utf-8&notice=0&format=jsonp&platform=h5&uin=0&needNewCode=1&jsonpCallback=callback",
      data: {
        g_tk: 5381,
        inCharset: 'utf-8',
        outCharset: 'utf-8',
        notice: 0,
        format: 'jsonp',
        platform: 'h5',
        uin: 0,
        needNewCode: 1,
        jsonpCallback: 'callback'
      },
      success: function (res) {
        if (res.statusCode === 200) {
          var res1 = res.data.replace("callback(", "")
          var res2 = JSON.parse(res1.replace(")", ""))
          _that.setData({
            slider: res2.data.slider,
          })
        }
      }
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})