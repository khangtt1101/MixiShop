```markdown
# Design System Document

## 1. Overview & Creative North Star: "The Brutalist Gallery"

This design system is built to transform a standard e-commerce interface into a high-fashion editorial experience. The "Creative North Star" is **The Brutalist Gallery**: an aesthetic that marries the raw, urban energy of streetwear with the precision of a luxury art exhibition. 

We move beyond the "template" look by rejecting traditional UI crutches—like borders and standard drop shadows—in favor of **intentional asymmetry**, **extreme typographic scale**, and **tonal layering**. The goal is a digital space that feels as curated as a flagship store in Soho. Layouts should feel expansive, utilizing the 0px roundedness constraint to create sharp, architectural silhouettes that command respect.

---

## 2. Colors & Surface Architecture

The palette is a high-contrast study in monochromatic depth. We utilize a "Dark Mode First" approach where the absence of light defines the form.

### The "No-Line" Rule
**Standard 1px solid borders are strictly prohibited for sectioning.** To define boundaries, designers must use background color shifts. For example, a product grid utilizing `surface-container-low` should sit directly against a `background` (#131313) canvas. The transition of tone is the only permissible divider.

### Surface Hierarchy & Nesting
Depth is achieved through a "Stacked Paper" metaphor. Treat the UI as a series of physical layers:
- **Base Layer:** `surface` (#131313) for the primary page background.
- **Sectioning:** Use `surface-container-low` (#1b1b1b) for large layout blocks.
- **Elevated Components:** Use `surface-container-high` (#2a2a2a) or `highest` (#353535) for cards or interactive modules that need to sit "closer" to the user.

### Glass & Signature Textures
To break the flatness of dark mode, use **Glassmorphism** for floating elements (like persistent navigation or quick-add modals):
- **Fill:** `surface` at 70% opacity.
- **Effect:** Backdrop Blur (20px–40px).
- **CTA Soul:** For primary buttons or hero accents, use a subtle linear gradient from `primary` (#ffffff) to `primary_container` (#d4d4d4) at a 45-degree angle to provide a metallic, premium sheen.

---

## 3. Typography

The typography scale is the primary driver of the brand's "High-Fashion" voice. It relies on the tension between the aggressive, wide stance of **Space Grotesk** and the utilitarian precision of **Inter**.

- **Display & Headlines (Space Grotesk):** These are your "billboard" moments. Use `display-lg` (3.5rem) with tight letter-spacing (-0.02em) to create impactful, editorial headers. Headlines should often be all-caps to mimic luxury streetwear branding.
- **Titles & UI (Inter):** Used for product names and navigational elements. `title-lg` (1.375rem) provides a clear, readable anchor without distracting from the display type.
- **Body & Labels (Inter):** `body-md` (0.875rem) is the workhorse. Keep line heights generous (1.6) to ensure the minimalist aesthetic feels breathable and premium.

---

## 4. Elevation & Depth

In this system, elevation is a matter of light and tone, not structure.

- **The Layering Principle:** Avoid shadows for static elements. If a card needs to stand out, place a `surface-container-highest` card on a `surface-container-low` section. This creates "Natural Lift."
- **Ambient Shadows:** When an element *must* float (e.g., a cart drawer), use a shadow with a 60px blur, 0px spread, and 6% opacity using the `on_surface` color. It should feel like a soft glow rather than a dark stain.
- **The "Ghost Border" Fallback:** If a container lacks sufficient contrast against a background, use the `outline_variant` (#474747) at **15% opacity**. It should be felt, not seen.
- **Angular Sharpness:** All components must maintain a **0px border-radius**. This "Hard Edge" philosophy reinforces the architectural, urban aesthetic.

---

## 5. Components

### Buttons
- **Primary:** `primary` (#ffffff) fill with `on_primary` (#1a1c1c) text. 0px radius. Use `spacing-4` (1.4rem) horizontal padding. High-gloss hover state (slight opacity dip to 90%).
- **Secondary:** `outline` (#919191) Ghost Border (20% opacity) with `primary` text.
- **Tertiary:** Pure text in `primary`, all-caps, with a 1px `primary` underline offset by 4px.

### Cards & Product Grids
**Strictly no dividers.** Use `spacing-8` (2.75rem) to separate product cards. The product image should be the hero, using `surface-container-lowest` as a placeholder background for transparency-heavy photography.

### Input Fields
Minimalist underlines only. Use `outline_variant` for the default state and `primary` for the active/focus state. Helper text must use `label-sm` in `on_surface_variant`.

### Navigation Elements
- **Breadcrumbs:** Use `label-md` in `on_secondary_fixed_variant` (#3a3c3c).
- **Cart/Menu:** Use Glassmorphism (backdrop-blur) to overlay the content, maintaining the sense that the user is still within the "Gallery."

### The "Drop" Countdown (Contextual Component)
A high-contrast banner using `surface-bright` (#393939) with `display-sm` typography to create urgency for limited streetwear releases.

---

## 6. Do's and Don'ts

### Do
- **Use White Space as a Luxury:** If you think there is enough space, add 20% more. Premium brands "waste" space to show they aren't desperate for a click.
- **Use Asymmetric Grids:** Offset images or text blocks by one column to create a sophisticated, editorial rhythm.
- **Lean into High Contrast:** Ensure `primary` white text on `background` black hits maximum legibility.

### Don't
- **Never use 100% opaque borders:** They clutter the "Gallery" and feel like a cheap template.
- **Never round a corner:** Even a 2px radius destroys the "Hard Edge" urban aesthetic of this system.
- **Avoid standard "Blue" links:** All interactive states must remain within the monochromatic scale, using underlines or opacity shifts for feedback.
- **No standard icons:** Use custom, ultra-thin stroke icons (0.5px to 1px) to match the Inter typography weight.```