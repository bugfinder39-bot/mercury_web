import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PublicController::home
 * @see app/Http/Controllers/PublicController.php:27
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
 * @see app/Http/Controllers/PublicController.php:27
 * @route '/'
 */
home.url = (options?: RouteQueryOptions) => {
    return home.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::home
 * @see app/Http/Controllers/PublicController.php:27
 * @route '/'
 */
home.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: home.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PublicController::home
 * @see app/Http/Controllers/PublicController.php:27
 * @route '/'
 */
home.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: home.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\PublicController::home
 * @see app/Http/Controllers/PublicController.php:27
 * @route '/'
 */
    const homeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: home.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\PublicController::home
 * @see app/Http/Controllers/PublicController.php:27
 * @route '/'
 */
        homeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: home.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\PublicController::home
 * @see app/Http/Controllers/PublicController.php:27
 * @route '/'
 */
        homeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: home.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    home.form = homeForm
/**
* @see \App\Http\Controllers\PublicController::about
 * @see app/Http/Controllers/PublicController.php:64
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
 * @see app/Http/Controllers/PublicController.php:64
 * @route '/about'
 */
about.url = (options?: RouteQueryOptions) => {
    return about.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::about
 * @see app/Http/Controllers/PublicController.php:64
 * @route '/about'
 */
about.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: about.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PublicController::about
 * @see app/Http/Controllers/PublicController.php:64
 * @route '/about'
 */
about.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: about.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\PublicController::about
 * @see app/Http/Controllers/PublicController.php:64
 * @route '/about'
 */
    const aboutForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: about.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\PublicController::about
 * @see app/Http/Controllers/PublicController.php:64
 * @route '/about'
 */
        aboutForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: about.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\PublicController::about
 * @see app/Http/Controllers/PublicController.php:64
 * @route '/about'
 */
        aboutForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: about.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    about.form = aboutForm
/**
* @see \App\Http\Controllers\PublicController::services
 * @see app/Http/Controllers/PublicController.php:83
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
 * @see app/Http/Controllers/PublicController.php:83
 * @route '/services'
 */
services.url = (options?: RouteQueryOptions) => {
    return services.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::services
 * @see app/Http/Controllers/PublicController.php:83
 * @route '/services'
 */
services.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: services.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PublicController::services
 * @see app/Http/Controllers/PublicController.php:83
 * @route '/services'
 */
services.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: services.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\PublicController::services
 * @see app/Http/Controllers/PublicController.php:83
 * @route '/services'
 */
    const servicesForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: services.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\PublicController::services
 * @see app/Http/Controllers/PublicController.php:83
 * @route '/services'
 */
        servicesForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: services.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\PublicController::services
 * @see app/Http/Controllers/PublicController.php:83
 * @route '/services'
 */
        servicesForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: services.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    services.form = servicesForm
/**
* @see \App\Http\Controllers\PublicController::contact
 * @see app/Http/Controllers/PublicController.php:98
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
 * @see app/Http/Controllers/PublicController.php:98
 * @route '/contact'
 */
contact.url = (options?: RouteQueryOptions) => {
    return contact.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::contact
 * @see app/Http/Controllers/PublicController.php:98
 * @route '/contact'
 */
contact.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: contact.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PublicController::contact
 * @see app/Http/Controllers/PublicController.php:98
 * @route '/contact'
 */
contact.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: contact.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\PublicController::contact
 * @see app/Http/Controllers/PublicController.php:98
 * @route '/contact'
 */
    const contactForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: contact.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\PublicController::contact
 * @see app/Http/Controllers/PublicController.php:98
 * @route '/contact'
 */
        contactForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: contact.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\PublicController::contact
 * @see app/Http/Controllers/PublicController.php:98
 * @route '/contact'
 */
        contactForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: contact.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    contact.form = contactForm
/**
* @see \App\Http\Controllers\PublicController::submitContactForm
 * @see app/Http/Controllers/PublicController.php:125
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
 * @see app/Http/Controllers/PublicController.php:125
 * @route '/contact'
 */
submitContactForm.url = (options?: RouteQueryOptions) => {
    return submitContactForm.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::submitContactForm
 * @see app/Http/Controllers/PublicController.php:125
 * @route '/contact'
 */
submitContactForm.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: submitContactForm.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\PublicController::submitContactForm
 * @see app/Http/Controllers/PublicController.php:125
 * @route '/contact'
 */
    const submitContactFormForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: submitContactForm.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\PublicController::submitContactForm
 * @see app/Http/Controllers/PublicController.php:125
 * @route '/contact'
 */
        submitContactFormForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: submitContactForm.url(options),
            method: 'post',
        })
    
    submitContactForm.form = submitContactFormForm
/**
* @see \App\Http\Controllers\PublicController::comingSoon
 * @see app/Http/Controllers/PublicController.php:111
 * @route '/coming-soon'
 */
export const comingSoon = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: comingSoon.url(options),
    method: 'get',
})

comingSoon.definition = {
    methods: ["get","head"],
    url: '/coming-soon',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PublicController::comingSoon
 * @see app/Http/Controllers/PublicController.php:111
 * @route '/coming-soon'
 */
comingSoon.url = (options?: RouteQueryOptions) => {
    return comingSoon.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::comingSoon
 * @see app/Http/Controllers/PublicController.php:111
 * @route '/coming-soon'
 */
comingSoon.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: comingSoon.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PublicController::comingSoon
 * @see app/Http/Controllers/PublicController.php:111
 * @route '/coming-soon'
 */
comingSoon.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: comingSoon.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\PublicController::comingSoon
 * @see app/Http/Controllers/PublicController.php:111
 * @route '/coming-soon'
 */
    const comingSoonForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: comingSoon.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\PublicController::comingSoon
 * @see app/Http/Controllers/PublicController.php:111
 * @route '/coming-soon'
 */
        comingSoonForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: comingSoon.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\PublicController::comingSoon
 * @see app/Http/Controllers/PublicController.php:111
 * @route '/coming-soon'
 */
        comingSoonForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: comingSoon.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    comingSoon.form = comingSoonForm
/**
* @see \App\Http\Controllers\PublicController::exchangeRates
 * @see app/Http/Controllers/PublicController.php:50
 * @route '/exchange-rates'
 */
export const exchangeRates = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: exchangeRates.url(options),
    method: 'get',
})

exchangeRates.definition = {
    methods: ["get","head"],
    url: '/exchange-rates',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PublicController::exchangeRates
 * @see app/Http/Controllers/PublicController.php:50
 * @route '/exchange-rates'
 */
exchangeRates.url = (options?: RouteQueryOptions) => {
    return exchangeRates.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PublicController::exchangeRates
 * @see app/Http/Controllers/PublicController.php:50
 * @route '/exchange-rates'
 */
exchangeRates.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: exchangeRates.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PublicController::exchangeRates
 * @see app/Http/Controllers/PublicController.php:50
 * @route '/exchange-rates'
 */
exchangeRates.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: exchangeRates.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\PublicController::exchangeRates
 * @see app/Http/Controllers/PublicController.php:50
 * @route '/exchange-rates'
 */
    const exchangeRatesForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: exchangeRates.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\PublicController::exchangeRates
 * @see app/Http/Controllers/PublicController.php:50
 * @route '/exchange-rates'
 */
        exchangeRatesForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: exchangeRates.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\PublicController::exchangeRates
 * @see app/Http/Controllers/PublicController.php:50
 * @route '/exchange-rates'
 */
        exchangeRatesForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: exchangeRates.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    exchangeRates.form = exchangeRatesForm
const PublicController = { home, about, services, contact, submitContactForm, comingSoon, exchangeRates }

export default PublicController