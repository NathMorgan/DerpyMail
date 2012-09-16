<script charset="utf-8" src="/scripts/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 5,
  interval: 30000,
  width: 230,
  height: 438,
  theme: {
    shell: {
      background: 'rgba(0, 0, 0, 0.0)',
      color: '#ffffff'
    },
    tweets: {
      background: 'rgba(255, 255, 255, 0.31)',
      color: '#000000',
      links: '#097da8'
    }
  },
  features: {
    scrollbar: true,
    loop: false,
    live: true,
    behavior: 'all'
  }
}).render().setUser('DerpyMail').start();
</script>