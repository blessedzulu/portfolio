---
extends: _layouts.post
section: content
title: A fluid that spells BZ
date: 2026-07-15
description: The header on this site is a small fluid simulation rendered as letters.
---

The header on this site is a small fluid simulation. Not a video, not a shader. It is a grid of letters, redrawn every frame, where each character stands in for how much fluid is sitting in that patch of the screen. When it settles, the denser parts spell out my initials.

The physics is not mine. It is Matthias Müller's FLIP fluid from his Ten Minute Physics series, which is open for anyone to use, by way of a version [Javier Bórquez](https://github.com/javierbyte/fluid-triangle) tuned for ASCII. I kept the solver and changed the part that matters here: what it draws with.

## Letters as a density ramp

The trick in the ASCII version is that each cell picks a character based on how full it is. Empty cells get a space, barely-wet cells get a dot, and the fullest cells get a solid glyph. Swap the solid glyphs for the letters you want and the fluid starts writing.

```
const RENDER_CHARS = [
  [["B", 30000], ["B", 30000], ["b", 19000], ...BASE],
  [["Z", 26000], ["Z", 26000], ["z", 16000], ...BASE],
];
```

Two ramps, one ending in B and one in Z, assigned to alternating diagonal bands. The falling fluid fills them in, so where it pools you read BZ, and where it thins out you get the quieter marks fading to nothing.

## Keeping it quiet

The easy mistake is to let a thing like this shout. So it is calm on purpose. Muted ink on paper rather than white on black, faded at the edges so it reads as a backdrop and not a poster, and paused the moment it scrolls out of view. A header should stay a header.
