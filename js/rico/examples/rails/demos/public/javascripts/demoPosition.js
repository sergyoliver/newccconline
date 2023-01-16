Event.observe(window, 'load', function(){
  EffectDemo.startLeft = $('effect_object').offsetLeft
  EffectDemo.startSize = $('effect_object').offsetWidth
  EffectDemo.startFade = 1;
});
  
  
EffectDemo = {
   sizeEffectStarted: false,
   positionEffectStarted: false,
   fadeEffectStarted: false,
   animator: new Rico.Effect.Animator(),   
   play: function(effect) {
      EffectDemo.animator.play(effect, {steps:20, duration:700});
   },
   pauseplay: function() {
     if (EffectDemo.animator.isPlaying())
          EffectDemo.animator.pause();
      else
          EffectDemo.animator.resume();
   },   
  togglePosition: function(){
    return new Rico.Effect.Position($('effect_object'), EffectDemo.nextPosition(), null);
  },  
  toggleSize: function(){  
    return new Rico.Effect.SizeAndPosition($('effect_object'), null, null, EffectDemo.nextSize(), null);
  },
  toggleSizeAndPosition: function(){  
    return new Rico.Effect.SizeAndPosition($('effect_object'), EffectDemo.nextPosition(), null,
                                                               EffectDemo.nextSize(), null );
  },
  toggleFade: function(){  
    EffectDemo.fadeEffectStarted = !EffectDemo.fadeEffectStarted
    if (!EffectDemo.fadeEffectStarted )    
      return new Rico.Effect.FadeOut($('effect_object'));
    else
      return new Rico.Effect.FadeIn($('effect_object'));
  },
  nextPosition: function(){
    EffectDemo.positionEffectStarted = !EffectDemo.positionEffectStarted
    return !EffectDemo.positionEffectStarted ? EffectDemo.startLeft : 520;    
  },
  nextSize: function(){
    EffectDemo.sizeEffectStarted = !EffectDemo.sizeEffectStarted
    return !EffectDemo.sizeEffectStarted ? EffectDemo.startSize : 350;    
  }
}