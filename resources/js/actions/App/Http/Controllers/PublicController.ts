import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PublicController::home
 * @see app/Http/Controllers/PublicController.php:23
 * @route '/'
 */
export const home = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: home.url(options),
    method: 'get',
})

home.definition = {
    methods: ["get","head"],
    url: '/',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PublicController::home
 * @see app/Http/Controllers/PublicController.php:23
 * @route '/'
 */
home.url = (options?: RouteQueryOptions) => {
    return home.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::home
 * @see app/Http/Controllers/PublicController.php:23
 * @route '/'
 */
home.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: home.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PublicController::home
 * @see app/Http/Controllers/PublicController.php:23
 * @route '/'
 */
home.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: home.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PublicController::about
 * @see app/Http/Controllers/PublicController.php:40
 * @route '/about'
 */
export const about = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: about.url(options),
    method: 'get',
})

about.definition = {
    methods: ["get","head"],
    url: '/about',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PublicController::about
 * @see app/Http/Controllers/PublicController.php:40
 * @route '/about'
 */
about.url = (options?: RouteQueryOptions) => {
    return about.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::about
 * @see app/Http/Controllers/PublicController.php:40
 * @route '/about'
 */
about.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: about.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PublicController::about
 * @see app/Http/Controllers/PublicController.php:40
 * @route '/about'
 */
about.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: about.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PublicController::services
 * @see app/Http/Controllers/PublicController.php:59
 * @route '/services'
 */
export const services = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: services.url(options),
    method: 'get',
})

services.definition = {
    methods: ["get","head"],
    url: '/services',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PublicController::services
 * @see app/Http/Controllers/PublicController.php:59
 * @route '/services'
 */
services.url = (options?: RouteQueryOptions) => {
    return services.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::services
 * @see app/Http/Controllers/PublicController.php:59
 * @route '/services'
 */
services.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: services.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PublicController::services
 * @see app/Http/Controllers/PublicController.php:59
 * @route '/services'
 */
services.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: services.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PublicController::contact
 * @see app/Http/Controllers/PublicController.php:74
 * @route '/contact'
 */
export const contact = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: contact.url(options),
    method: 'get',
})

contact.definition = {
    methods: ["get","head"],
    url: '/contact',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PublicController::contact
 * @see app/Http/Controllers/PublicController.php:74
 * @route '/contact'
 */
contact.url = (options?: RouteQueryOptions) => {
    return contact.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::contact
 * @see app/Http/Controllers/PublicController.php:74
 * @route '/contact'
 */
contact.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: contact.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PublicController::contact
 * @see app/Http/Controllers/PublicController.php:74
 * @route '/contact'
 */
contact.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: contact.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PublicController::submitContactForm
 * @see app/Http/Controllers/PublicController.php:87
 * @route '/contact'
 */
export const submitContactForm = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: submitContactForm.url(options),
    method: 'post',
})

submitContactForm.definition = {
    methods: ["post"],
    url: '/contact',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PublicController::submitContactForm
 * @see app/Http/Controllers/PublicController.php:87
 * @route '/contact'
 */
submitContactForm.url = (options?: RouteQueryOptions) => {
    return submitContactForm.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::submitContactForm
 * @see app/Http/Controllers/PublicController.php:87
 * @route '/contact'
 */
submitContactForm.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: submitContactForm.url(options),
    method: 'post',
})
const PublicController = { home, about, services, contact, submitContactForm }

export default PublicController