# Android Development - HTTP Libraries

| Library | Characteristice | Best for |
|----------|:-------------:|------:|
| RetroFit |  Easy to extract/morph data afterwards (using model class); Dynamic URL; Performance as good as Volley; a bit harder to setup than Volley | Text (large amounts of data) |
| OkHttp | Used by RetroFit |  |
| Volley | Easy setup; Have to morph data manually afterwards | Text (small amounts of data) |
| OkHttp | Complex and slow; Generally bad | Perhaps only good for streaming audio and video |
| Picasso | Complex setup; Memory leaks |  |
| Glide | Slow | Images (small amounts of data) |
| Universal Image Loader |  | Images |

- https://hackernoon.com/picasso-universal-image-loader-or-glide-that-s-the-question-af34fa7f5e63
- https://medium.com/@ali.muzaffar/is-retrofit-faster-than-volley-the-answer-may-surprise-you-4379bc589d7c
