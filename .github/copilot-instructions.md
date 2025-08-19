# Content Animations TYPO3 Extension

Content Animations is a TYPO3 CMS extension that adds frontend animations to content elements when they scroll into the browser viewport. The extension provides animation controls in the TYPO3 backend and renders data attributes that work with the Simple-AOS JavaScript library.

Always reference these instructions first and fallback to search or bash commands only when you encounter unexpected information that does not match the info here.

## Working Effectively

### Bootstrap and Build the Repository

Install PHP dependencies:
- `composer install --no-dev` -- production dependencies only, takes ~15 seconds to complete
- `composer install` -- full dependencies including dev tools, takes 8-15 minutes. NEVER CANCEL. Set timeout to 20+ minutes.
- Dependencies include 125+ packages (TYPO3 core, Symfony components, development tools)
- May require GitHub token for private repositories - creates `.build/vendor/` directory
- Network timeouts are common and expected - the command will retry automatically

**Development Workflow Recommendation:**
1. Start with `composer install --no-dev` for fast basic validation
2. Run `composer install` only when you need dev tools (linting, static analysis)
3. Use `composer validate` to check composer.json syntax

Validate installation:
- `php -l Classes/Form/Elements/AnimationPreviewField.php` -- basic PHP syntax check (< 1 second)
- `find Classes/ -name "*.php" -exec php -l {} \;` -- check all PHP files (~0.1 seconds total)
- `.build/bin/typo3 --version` -- verify TYPO3 CLI tools are available

### Code Quality and Testing

Run linting and static analysis:
- `composer run test:php:lint` -- PHPLint syntax validation. Requires full dev dependencies. (< 30 seconds)
- `composer run cgl` -- PHP-CS-Fixer code formatting. Requires full dev dependencies. (1-3 minutes)
- `composer run cgl:ci` -- PHP-CS-Fixer dry-run for CI validation. Requires full dev dependencies. (1-3 minutes)
- `composer run phpstan` -- Static analysis with PHPStan. Requires full dev dependencies. (2-5 minutes). NEVER CANCEL. Set timeout to 10+ minutes.

### TYPO3 Development Environment

Set up local development environment:
- Install DDEV: Follow DDEV installation instructions for your OS
- `ddev start` -- starts Apache, MySQL, PHP 8.4 environment (1-2 minutes)
- `ddev composer install` -- run composer inside DDEV container if needed
- Access TYPO3 backend at: `https://content-animations.ddev.site/typo3`

## Validation

### Code Validation
- ALWAYS run basic PHP syntax validation: `php -l` on changed files
- ALWAYS run `composer run cgl` to ensure code formatting standards
- ALWAYS run `composer run phpstan` for static analysis before submitting changes
- The extension has NO unit tests - only code quality validation is available

### Manual Testing Scenarios
Since this is a TYPO3 extension, manual validation requires a TYPO3 instance:

1. **Backend Validation**: 
   - Create content element in TYPO3 backend
   - Verify animation settings are available in "Animation" tab
   - Check animation preview functionality works

2. **Frontend Validation**:
   - Include static TypoScript: "Content Animations: Bootstrap Package v15.x" or "Content Animations: Fluid Styled Content"
   - View frontend page with animated content elements
   - Verify data-aos attributes are rendered: `data-aos="fade-up"`, `data-aos-duration="800"`, etc.
   - Test scroll-triggered animations work in browser

### CI/Build Validation
- ALWAYS run `composer run cgl:ci` before committing (formatting check)
- ALWAYS run `composer run phpstan` before committing (static analysis)
- There are NO automated tests or GitHub workflows configured

## Common Tasks

### Repository Structure
```
.
├── Classes/                    # PHP source code (6 files)
│   ├── ContentObject/         # TYPO3 content objects
│   ├── DataProcessing/        # TypoScript data processors
│   └── Form/Elements/         # TYPO3 backend form elements
├── Configuration/             # TYPO3 configuration
│   ├── TCA/                   # Table Configuration Array
│   └── TypoScript/            # TypoScript templates
├── Resources/
│   ├── Private/               # Fluid templates and language files
│   └── Public/                # JavaScript, CSS, animation GIFs
├── Documentation/             # reStructuredText documentation
├── .ddev/                     # DDEV configuration
├── Build/                     # PHPStan configuration
├── composer.json              # Dependencies and scripts
└── ext_*.php                  # TYPO3 extension configuration (3 files)
```

**Total extension files**: 9 PHP files (small codebase, fast validation)

### Key Files to Check When Making Changes
- **Classes/Form/Elements/AnimationPreviewField.php**: Backend animation preview
- **Configuration/TCA/Overrides/tt_content.php**: Content element field definitions
- **Configuration/TypoScript/**: Animation rendering configuration
- **Resources/Public/JavaScript/**: Frontend animation library

### Development Workflow
1. Make code changes
2. Run `php -l` on changed PHP files
3. Run `composer run cgl` to format code
4. Run `composer run phpstan` to check for issues
5. Test in TYPO3 instance (backend + frontend)
6. Commit changes

## Critical Timing Information

**NEVER CANCEL these long-running commands:**
- `composer install` (full): 8-15 minutes (125+ dependencies, network timeouts expected)
- `composer install --no-dev` (production only): ~15 seconds (66 dependencies)
- `composer run phpstan`: 2-5 minutes (static analysis of TYPO3 core)
- `composer run cgl`: 1-3 minutes (formats all PHP files)

**Fast validation commands:**
- `php -l filename.php`: < 1 second per file
- `find Classes/ -name "*.php" -exec php -l {} \;`: ~0.1 seconds total
- `composer run test:php:lint`: < 30 seconds (requires dev dependencies)
- `composer run cgl:ci`: 1-3 minutes (dry-run, no changes, requires dev dependencies)

## Extension-Specific Information

### Animation Configuration
- Supported animations: fade, slide, zoom, flip variants
- Configuration fields: animation type, duration (400-3000ms), delay, easing
- Data attributes rendered: `data-aos`, `data-aos-duration`, `data-aos-delay`, etc.

### TypoScript Integration
- Choose between Bootstrap Package (v13-v15) or Fluid Styled Content includes
- Extends `lib.contentElement.layoutRootPaths.100`
- JavaScript included via `page.jsFooterInline`

### Dependencies
- PHP 8.2+ required
- TYPO3 12.4 - 13.4 LTS
- Simple-AOS JavaScript library (included)
- Bootstrap Package optional integration

## Troubleshooting

### Common Issues
- **Composer timeouts**: Expected due to 125+ dependencies, let it retry
- **GitHub authentication**: May need token for private repos
- **PHPStan memory**: Large codebase analysis, may need memory increase
- **DDEV not starting**: Check Docker is running, run `ddev poweroff && ddev start`

### When Build/Validation Fails
- Check PHP syntax first: `find Classes/ -name "*.php" -exec php -l {} \;`
- Verify composer dependencies: `composer validate`
- Check TYPO3 compatibility: Review ext_emconf.php version constraints
- Review PHPStan baseline: Check Build/phpstan-baseline.neon for known issues

## Quick Reference

**Essential Commands for Development:**
```bash
# Fast setup (production dependencies only)
composer install --no-dev  # 15 seconds

# Basic validation (no dependencies needed)
php -l Classes/Form/Elements/AnimationPreviewField.php
find Classes/ -name "*.php" -exec php -l {} \;

# Full development setup (when needed)
composer install  # 8-15 minutes, requires patience

# Code quality (requires full install)
composer run cgl
composer run phpstan
```

**Key Facts:**
- 9 PHP files in extension (fast to validate)
- 6,641 total PHP files with dependencies
- No unit tests - only code quality tools
- TYPO3 extension requiring TYPO3 instance for full testing
- Network issues common during dependency installation