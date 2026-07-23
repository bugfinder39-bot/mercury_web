import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::refreshRates
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:156
 * @route '/admin/exchange-rates/refresh-rates'
 */
export const refreshRates = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: refreshRates.url(options),
    method: 'post',
})

refreshRates.definition = {
    methods: ["post"],
    url: '/admin/exchange-rates/refresh-rates',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::refreshRates
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:156
 * @route '/admin/exchange-rates/refresh-rates'
 */
refreshRates.url = (options?: RouteQueryOptions) => {
    return refreshRates.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::refreshRates
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:156
 * @route '/admin/exchange-rates/refresh-rates'
 */
refreshRates.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: refreshRates.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::refreshRates
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:156
 * @route '/admin/exchange-rates/refresh-rates'
 */
    const refreshRatesForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: refreshRates.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::refreshRates
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:156
 * @route '/admin/exchange-rates/refresh-rates'
 */
        refreshRatesForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: refreshRates.url(options),
            method: 'post',
        })
    
    refreshRates.form = refreshRatesForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::testConnection
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:174
 * @route '/admin/exchange-rates/test-connection'
 */
export const testConnection = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: testConnection.url(options),
    method: 'post',
})

testConnection.definition = {
    methods: ["post"],
    url: '/admin/exchange-rates/test-connection',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::testConnection
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:174
 * @route '/admin/exchange-rates/test-connection'
 */
testConnection.url = (options?: RouteQueryOptions) => {
    return testConnection.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::testConnection
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:174
 * @route '/admin/exchange-rates/test-connection'
 */
testConnection.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: testConnection.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::testConnection
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:174
 * @route '/admin/exchange-rates/test-connection'
 */
    const testConnectionForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: testConnection.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::testConnection
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:174
 * @route '/admin/exchange-rates/test-connection'
 */
        testConnectionForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: testConnection.url(options),
            method: 'post',
        })
    
    testConnection.form = testConnectionForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::toggleStatus
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:188
 * @route '/admin/exchange-rates/{exchangeRate}/toggle-status'
 */
export const toggleStatus = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleStatus.url(args, options),
    method: 'patch',
})

toggleStatus.definition = {
    methods: ["patch"],
    url: '/admin/exchange-rates/{exchangeRate}/toggle-status',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::toggleStatus
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:188
 * @route '/admin/exchange-rates/{exchangeRate}/toggle-status'
 */
toggleStatus.url = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exchangeRate: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { exchangeRate: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    exchangeRate: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        exchangeRate: typeof args.exchangeRate === 'object'
                ? args.exchangeRate.id
                : args.exchangeRate,
                }

    return toggleStatus.definition.url
            .replace('{exchangeRate}', parsedArgs.exchangeRate.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::toggleStatus
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:188
 * @route '/admin/exchange-rates/{exchangeRate}/toggle-status'
 */
toggleStatus.patch = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleStatus.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::toggleStatus
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:188
 * @route '/admin/exchange-rates/{exchangeRate}/toggle-status'
 */
    const toggleStatusForm = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: toggleStatus.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PATCH',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::toggleStatus
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:188
 * @route '/admin/exchange-rates/{exchangeRate}/toggle-status'
 */
        toggleStatusForm.patch = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: toggleStatus.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    toggleStatus.form = toggleStatusForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::toggleManual
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:200
 * @route '/admin/exchange-rates/{exchangeRate}/toggle-manual'
 */
export const toggleManual = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleManual.url(args, options),
    method: 'patch',
})

toggleManual.definition = {
    methods: ["patch"],
    url: '/admin/exchange-rates/{exchangeRate}/toggle-manual',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::toggleManual
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:200
 * @route '/admin/exchange-rates/{exchangeRate}/toggle-manual'
 */
toggleManual.url = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exchangeRate: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { exchangeRate: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    exchangeRate: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        exchangeRate: typeof args.exchangeRate === 'object'
                ? args.exchangeRate.id
                : args.exchangeRate,
                }

    return toggleManual.definition.url
            .replace('{exchangeRate}', parsedArgs.exchangeRate.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::toggleManual
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:200
 * @route '/admin/exchange-rates/{exchangeRate}/toggle-manual'
 */
toggleManual.patch = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleManual.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::toggleManual
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:200
 * @route '/admin/exchange-rates/{exchangeRate}/toggle-manual'
 */
    const toggleManualForm = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: toggleManual.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PATCH',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::toggleManual
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:200
 * @route '/admin/exchange-rates/{exchangeRate}/toggle-manual'
 */
        toggleManualForm.patch = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: toggleManual.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    toggleManual.form = toggleManualForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::restoreLive
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:235
 * @route '/admin/exchange-rates/{exchangeRate}/restore-live'
 */
export const restoreLive = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: restoreLive.url(args, options),
    method: 'post',
})

restoreLive.definition = {
    methods: ["post"],
    url: '/admin/exchange-rates/{exchangeRate}/restore-live',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::restoreLive
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:235
 * @route '/admin/exchange-rates/{exchangeRate}/restore-live'
 */
restoreLive.url = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exchangeRate: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { exchangeRate: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    exchangeRate: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        exchangeRate: typeof args.exchangeRate === 'object'
                ? args.exchangeRate.id
                : args.exchangeRate,
                }

    return restoreLive.definition.url
            .replace('{exchangeRate}', parsedArgs.exchangeRate.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::restoreLive
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:235
 * @route '/admin/exchange-rates/{exchangeRate}/restore-live'
 */
restoreLive.post = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: restoreLive.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::restoreLive
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:235
 * @route '/admin/exchange-rates/{exchangeRate}/restore-live'
 */
    const restoreLiveForm = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: restoreLive.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::restoreLive
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:235
 * @route '/admin/exchange-rates/{exchangeRate}/restore-live'
 */
        restoreLiveForm.post = (args: { exchangeRate: number | { id: number } } | [exchangeRate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: restoreLive.url(args, options),
            method: 'post',
        })
    
    restoreLive.form = restoreLiveForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::reorder
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:253
 * @route '/admin/exchange-rates/reorder'
 */
export const reorder = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reorder.url(options),
    method: 'post',
})

reorder.definition = {
    methods: ["post"],
    url: '/admin/exchange-rates/reorder',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::reorder
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:253
 * @route '/admin/exchange-rates/reorder'
 */
reorder.url = (options?: RouteQueryOptions) => {
    return reorder.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::reorder
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:253
 * @route '/admin/exchange-rates/reorder'
 */
reorder.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reorder.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::reorder
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:253
 * @route '/admin/exchange-rates/reorder'
 */
    const reorderForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: reorder.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::reorder
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:253
 * @route '/admin/exchange-rates/reorder'
 */
        reorderForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: reorder.url(options),
            method: 'post',
        })
    
    reorder.form = reorderForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::updateSettings
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:271
 * @route '/admin/exchange-rates/settings'
 */
export const updateSettings = (options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateSettings.url(options),
    method: 'put',
})

updateSettings.definition = {
    methods: ["put"],
    url: '/admin/exchange-rates/settings',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::updateSettings
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:271
 * @route '/admin/exchange-rates/settings'
 */
updateSettings.url = (options?: RouteQueryOptions) => {
    return updateSettings.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::updateSettings
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:271
 * @route '/admin/exchange-rates/settings'
 */
updateSettings.put = (options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateSettings.url(options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::updateSettings
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:271
 * @route '/admin/exchange-rates/settings'
 */
    const updateSettingsForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: updateSettings.url({
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::updateSettings
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:271
 * @route '/admin/exchange-rates/settings'
 */
        updateSettingsForm.put = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: updateSettings.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    updateSettings.form = updateSettingsForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::index
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:27
 * @route '/admin/exchange-rates'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/exchange-rates',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::index
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:27
 * @route '/admin/exchange-rates'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::index
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:27
 * @route '/admin/exchange-rates'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::index
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:27
 * @route '/admin/exchange-rates'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::index
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:27
 * @route '/admin/exchange-rates'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::index
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:27
 * @route '/admin/exchange-rates'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::index
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:27
 * @route '/admin/exchange-rates'
 */
        indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index.form = indexForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::create
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/exchange-rates/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::create
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::create
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::create
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::create
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::create
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::create
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/create'
 */
        createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    create.form = createForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::store
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:81
 * @route '/admin/exchange-rates'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/exchange-rates',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::store
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:81
 * @route '/admin/exchange-rates'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::store
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:81
 * @route '/admin/exchange-rates'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::store
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:81
 * @route '/admin/exchange-rates'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::store
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:81
 * @route '/admin/exchange-rates'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::show
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
export const show = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/exchange-rates/{exchange_rate}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::show
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
show.url = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exchange_rate: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    exchange_rate: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        exchange_rate: args.exchange_rate,
                }

    return show.definition.url
            .replace('{exchange_rate}', parsedArgs.exchange_rate.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::show
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
show.get = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::show
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
show.head = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::show
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
    const showForm = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::show
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
        showForm.get = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::show
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
        showForm.head = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    show.form = showForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::edit
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}/edit'
 */
export const edit = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/exchange-rates/{exchange_rate}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::edit
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}/edit'
 */
edit.url = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exchange_rate: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    exchange_rate: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        exchange_rate: args.exchange_rate,
                }

    return edit.definition.url
            .replace('{exchange_rate}', parsedArgs.exchange_rate.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::edit
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}/edit'
 */
edit.get = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::edit
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}/edit'
 */
edit.head = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::edit
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}/edit'
 */
    const editForm = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::edit
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}/edit'
 */
        editForm.get = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::edit
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:0
 * @route '/admin/exchange-rates/{exchange_rate}/edit'
 */
        editForm.head = (args: { exchange_rate: string | number } | [exchange_rate: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    edit.form = editForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::update
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:110
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
export const update = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/admin/exchange-rates/{exchange_rate}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::update
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:110
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
update.url = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exchange_rate: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { exchange_rate: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    exchange_rate: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        exchange_rate: typeof args.exchange_rate === 'object'
                ? args.exchange_rate.id
                : args.exchange_rate,
                }

    return update.definition.url
            .replace('{exchange_rate}', parsedArgs.exchange_rate.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::update
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:110
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
update.put = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::update
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:110
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
update.patch = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::update
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:110
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
    const updateForm = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::update
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:110
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
        updateForm.put = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::update
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:110
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
        updateForm.patch = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::destroy
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:146
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
export const destroy = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/exchange-rates/{exchange_rate}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::destroy
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:146
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
destroy.url = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { exchange_rate: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { exchange_rate: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    exchange_rate: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        exchange_rate: typeof args.exchange_rate === 'object'
                ? args.exchange_rate.id
                : args.exchange_rate,
                }

    return destroy.definition.url
            .replace('{exchange_rate}', parsedArgs.exchange_rate.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ExchangeRateController::destroy
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:146
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
destroy.delete = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::destroy
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:146
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
    const destroyForm = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\ExchangeRateController::destroy
 * @see app/Http/Controllers/Admin/ExchangeRateController.php:146
 * @route '/admin/exchange-rates/{exchange_rate}'
 */
        destroyForm.delete = (args: { exchange_rate: number | { id: number } } | [exchange_rate: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const ExchangeRateController = { refreshRates, testConnection, toggleStatus, toggleManual, restoreLive, reorder, updateSettings, index, create, store, show, edit, update, destroy }

export default ExchangeRateController