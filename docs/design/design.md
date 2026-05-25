---
name: design-system-petjam
description: Creates implementation-ready design-system guidance with tokens, component behavior, and accessibility standards. Use when creating or updating UI rules, component specifications, or design-system documentation.
---

<!-- TYPEUI_SH_MANAGED_START -->

# PETJAM

## Mission
Deliver implementation-ready design-system guidance for PETJAM that can be applied consistently across web app interfaces.

## Brand
- Product/brand: PETJAM
- URL: https://pet-adoption-chi-six.vercel.app/login
- Audience: developers and technical teams
- Product surface: web app

## Style Foundations
- Visual style: structured, accessible, implementation-first
- Main font style: `font.family.primary=ui-sans-serif`, `font.family.stack=ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji`, `font.size.base=14px`, `font.weight.base=700`, `font.lineHeight.base=21px`
- Typography scale: `font.size.xs=12px`, `font.size.sm=13px`, `font.size.md=14px`, `font.size.lg=16px`, `font.size.xl=28px`, `font.size.2xl=36px`
- Color palette: `color.border.default=#ffffff`, `color.text.secondary=oklab(0.999994 0.0000455678 0.0000200868 / 0.9)`, `color.text.tertiary=#f08c50`, `color.text.inverse=lab(8.11897 0.811279 -12.254)`, `color.surface.base=#000000`, `color.surface.strong=oklab(0 0 0 / 0.2)`
- Spacing scale: `space.1=6px`, `space.2=8px`, `space.3=10px`, `space.4=12px`, `space.5=14px`, `space.6=20px`, `space.7=24px`, `space.8=32px`
- Radius/shadow/motion tokens: `radius.xs=8px`, `radius.sm=33554400px` | `shadow.1=rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0.05) 0px 2px 10px 0px, rgba(0, 0, 0, 0.03) 0px 1px 3px 0px inset`, `shadow.2=rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.1) 0px 4px 6px -4px`, `shadow.3=rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(240, 140, 80, 0.39) 0px 4px 14px 0px` | `motion.duration.instant=150ms`, `motion.duration.fast=200ms`

## Accessibility
- Target: WCAG 2.2 AA
- Keyboard-first interactions required.
- Focus-visible rules required.
- Contrast constraints required.

## Writing Tone
concise, confident, implementation-focused

## Rules: Do
- Use semantic tokens, not raw hex values in component guidance.
- Every component must define required states: default, hover, focus-visible, active, disabled, loading, error.
- Responsive behavior and edge-case handling should be specified for every component family.
- Accessibility acceptance criteria must be testable in implementation.

## Rules: Don't
- Do not allow low-contrast text or hidden focus indicators.
- Do not introduce one-off spacing or typography exceptions.
- Do not use ambiguous labels or non-descriptive actions.

## Guideline Authoring Workflow
1. Restate design intent in one sentence.
2. Define foundations and tokens.
3. Define component anatomy, variants, and interactions.
4. Add accessibility acceptance criteria.
5. Add anti-patterns and migration notes.
6. End with QA checklist.

## Required Output Structure
- Context and goals
- Design tokens and foundations
- Component-level rules (anatomy, variants, states, responsive behavior)
- Accessibility requirements and testable acceptance criteria
- Content and tone standards with examples
- Anti-patterns and prohibited implementations
- QA checklist

## Component Rule Expectations
- Include keyboard, pointer, and touch behavior.
- Include spacing and typography token requirements.
- Include long-content, overflow, and empty-state handling.

## Quality Gates
- Every non-negotiable rule must use "must".
- Every recommendation should use "should".
- Every accessibility rule must be testable in implementation.
- Prefer system consistency over local visual exceptions.

<!-- TYPEUI_SH_MANAGED_END -->
