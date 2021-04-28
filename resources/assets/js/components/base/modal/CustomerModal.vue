<template>
  <div class="customer-modal">
    <form action="" @submit.prevent="submitCustomerData">
      <div class="flex-1 p-5 sm:p-6">
        <sw-tabs>
          <!-- tab1 -->
          <sw-tab-item title="Información básica" class="mt-5">
            <sw-input-group
              :label="$t('customers.display_name')"
              :error="nameError"
              variant="horizontal"
              required
            >
              <sw-input
                ref="name"
                :invalid="$v.formData.name.$error"
                v-model.trim="formData.name"
                type="text"
                name="name"
                class="mt-1 md:mt-0"
                @input="$v.formData.name.$touch()"
              />
            </sw-input-group>

            <sw-input-group
              :label="$t('customers.primary_display_name')"
              class="mt-4"
              variant="horizontal"
            >
              <sw-input
                v-model="formData.contact_name"
                type="text"
                class="mt-1 md:mt-0"
              />
            </sw-input-group>

            <sw-input-group
              :label="$t('login.email')"
              :error="emailError"
              class="mt-4"
              variant="horizontal"
            >
              <sw-input
                :invalid="$v.formData.email.$error"
                v-model.trim="formData.email"
                type="text"
                name="email"
                class="mt-1 md:mt-0"
                @input="$v.formData.email.$touch()"
              />
            </sw-input-group>

            <sw-input-group
              :label="$t('customers.phone')"
              :error="phoneError"
              class="mt-4"
              variant="horizontal"
              required
            >
              <sw-input
                :invalid="$v.formData.phone.$error"
                v-model.trim="formData.phone"
                type="text"
                name="phone"
                class="mt-1 md:mt-0"
                @input="$v.formData.phone.$touch()"
              />
            </sw-input-group>
            <sw-divider class="mb-5 mt-5 md:mb-8" />
            <sw-input-group
              :label="$t('customers.address')"
              :error="ship1Error"
              class="mt-4"
              variant="horizontal"
              required
            >
              <sw-textarea
                v-model="shipping.address_street_1"
                :placeholder="$t('general.street_1')"
                :invalid="$v.shipping.address_street_1.$error"
                rows="2"
                cols="50"
                class="mt-1 md:mt-0"
                @input="$v.shipping.address_street_1.$touch()"
              />
            </sw-input-group>
            <br />
            <sw-input-group
              :error="ship2Error"
              label="Referencia dirección"
              class="mt-4"
              variant="horizontal"
            >
              <sw-textarea
                v-model="shipping.address_street_2"
                :placeholder="$t('general.street_2')"
                rows="2"
                cols="50"
                @input="$v.shipping.address_street_2.$touch()"
              />
              <br />
            </sw-input-group>
          </sw-tab-item>
        </sw-tabs>
      </div>
      <div
        class="z-0 flex justify-end p-4 border-t border-gray-200 border-solid"
      >
        <sw-button
          class="mr-3 text-sm"
          type="button"
          variant="primary-outline"
          @click="cancelCustomer"
        >
          {{ $t('general.cancel') }}
        </sw-button>
        <sw-button :loading="isLoading" variant="primary" type="submit">
          <save-icon v-if="!isLoading" class="mr-2" />
          {{ $t('general.save') }}
        </sw-button>
      </div>
    </form>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import AddressStub from '../../../stub/address'
const {
  required,
  minLength,
  email,
  numeric,
  maxLength,
} = require('vuelidate/lib/validators')

export default {
  data() {
    return {
      isEdit: false,
      isLoading: false,
      billingCountry: null,
      shippingCountry: null,
      isCopyFromBilling: false,
      currency: '',
      isDisabledBillingState: true,
      isDisabledBillingCity: true,
      isDisabledShippingState: true,
      isDisabledShippingCity: true,
      formData: {
        id: null,
        name: null,
        currency_id: null,
        phone: null,
        website: null,
        contact_name: null,
        addresses: [],
      },

      shipping: {
        name: null,
        country_id: null,
        state: null,
        city: null,
        phone: null,
        zip: null,
        address_street_1: null,
        address_street_2: null,
        type: 'shipping',
      },
    }
  },
  validations: {
    formData: {
      name: {
        required,
        minLength: minLength(3),
      },
      email: {
        email,
      },
      phone: {
        required,
        numeric,
        minLength: minLength(10),
        maxLength: maxLength(10),
      },
      contact_name: {
        minLength: minLength(5),
      },
    },
    shipping: {
      address_street_1: {
        required,
        maxLength: maxLength(255),
      },
      address_street_2: {
        maxLength: maxLength(255),
      },
    },
  },
  computed: {
    // ...mapGetters(['currencies', 'countries']),
    ...mapGetters('company', ['defaultCurrency']),
    ...mapGetters('modal', ['modalDataID', 'modalData', 'modalActive']),

    nameError() {
      if (!this.$v.formData.name.$error) {
        return ''
      }
      if (!this.$v.formData.name.required) {
        return this.$tc('validation.required')
      }
      if (!this.$v.formData.contact_name.required) {
        return this.$tc('validation.required')
      }
      if (!this.$v.formData.phone.required) {
        return this.$tc('validation.required')
      }
      if (!this.$v.formData.name.minLength) {
        return this.$tc(
          'validation.name_min_length',
          this.$v.formData.name.$params.minLength.min,
          { count: this.$v.formData.name.$params.minLength.min }
        )
      }
      if (!this.$v.formData.name.alpha) {
        return this.$tc('validation.characters_only')
      }
    },
    phoneError() {
      if (!this.$v.formData.phone.$error) {
        return ''
      }
      if (!this.$v.formData.phone.required) {
        return this.$tc('validation.required')
      } else {
        if (!this.$v.formData.phone.numeric) {
          return 'Solo acepta números'
        }

        if (!this.$v.formData.phone.minLength) {
          return 'Número incorrecto debe de tener 10 dígitos'
        }
        if (!this.$v.formData.phone.maxLength) {
          return 'Número incorrecto debe de tener 10 dígitos'
        }
      }
    },
    emailError() {
      if (!this.$v.formData.email.$error) {
        return ''
      }
      if (!this.$v.formData.email.email) {
        return this.$t('validation.email_incorrect')
      }
    },
    websiteError() {
      if (!this.$v.formData.website.$error) {
        return ''
      }
      if (!this.$v.formData.website.url) {
        return this.$tc('validation.invalid_url')
      }
    },
    bill1Error() {
      if (!this.$v.billing.address_street_1.$error) {
        return ''
      }
      if (!this.$v.billing.address_street_1.required) {
        return this.$tc('validation.required')
      }
      if (!this.$v.billing.address_street_1.maxLength) {
        return this.$t('validation.address_maxlength')
      }
    },
    bill2Error() {
      if (!this.$v.billing.address_street_2.$error) {
        return ''
      }
      if (!this.$v.billing.address_street_2.maxLength) {
        return this.$t('validation.address_maxlength')
      }
    },
    ship1Error() {
      if (!this.$v.shipping.address_street_1.$error) {
        return ''
      }
      if (!this.$v.shipping.address_street_1.required) {
        return this.$tc('validation.required')
      } else {
        if (!this.$v.shipping.address_street_1.maxLength) {
          return this.$t('validation.address_maxlength')
        }
      }
    },
    ship2Error() {
      if (!this.$v.shipping.address_street_2.$error) {
        return ''
      }
      if (!this.$v.shipping.address_street_2.maxLength) {
        return this.$t('validation.address_maxlength')
      }
    },

    hasBillingAdd() {
      let billing = this.billing
      if (
        billing.name ||
        billing.country_id ||
        billing.state ||
        billing.city ||
        billing.phone ||
        billing.zip ||
        billing.address_street_1 ||
        billing.address_street_2
      ) {
        return true
      }
      return false
    },
    hasShippingAdd() {
      let shipping = this.shipping
      if (
        shipping.name ||
        shipping.country_id ||
        shipping.state ||
        shipping.city ||
        shipping.phone ||
        shipping.zip ||
        shipping.address_street_1 ||
        shipping.address_street_2
      ) {
        return true
      }
      return false
    },
  },
  watch: {
    modalDataID(val) {
      if (val) {
        this.isEdit = true
        this.setData()
      } else {
        this.isEdit = false
      }
    },

    shippingCountry() {
      if (this.shippingCountry) {
        this.shipping.country_id = this.shippingCountry.id
        return true
      }
    },
  },
  mounted() {
    this.$refs.name.focus = true
    this.currency = this.defaultCurrency
    if (this.modalDataID) {
      this.setData()
    }
  },
  methods: {
    ...mapActions('invoice', {
      setInvoiceCustomer: 'selectCustomer',
    }),
    ...mapActions('estimate', {
      setEstimateCustomer: 'selectCustomer',
    }),
    ...mapActions('customer', [
      'fetchCustomer',
      'addCustomer',
      'updateCustomer',
    ]),
    ...mapActions('modal', ['closeModal']),
    ...mapActions('notification', ['showNotification']),
    resetData() {
      this.formData = {
        name: null,
        currency_id: null,
        phone: null,
        website: null,
        contact_name: null,
        addresses: [],
      }

      this.billingCountry = null
      this.shippingCountry = null

      this.shipping = { ...AddressStub }
      this.$v.formData.$reset()
    },
    cancelCustomer() {
      this.resetData()
      this.closeModal()
    },
    copyAddress(val) {
      if (val === true) {
        this.isCopyFromBilling = true
        this.shipping = { ...this.billing, type: 'shipping' }
        this.shippingCountry = this.billingCountry
      } else {
        this.shipping = { ...AddressStub, type: 'shipping' }
        this.shippingCountry = null
      }
    },
    async loadData() {
      let response = await this.fetchCustomer()
      this.formData.currency_id = response.data.currency.id
      return true
    },
    checkAddress() {
      const isShippingEmpty = Object.values(this.shipping).every(
        (val) => val === null || val === ''
      )
      if (isBillingEmpty === true) {
        this.formData.addresses = []
        return true
      }

      if (isShippingEmpty === false) {
        this.formData.addresses = [{ ...this.shipping, type: 'shipping' }]
        return true
      }

      this.formData.addresses = [{ ...this.shipping, type: 'shipping' }]
      return true
    },
    async setData() {
      this.formData.id = this.modalData.id
      this.formData.name = this.modalData.name
      this.formData.email = this.modalData.email
      this.formData.contact_name = this.modalData.contact_name
      this.formData.phone = this.modalData.phone
      this.formData.website = this.modalData.website
      // this.currency = this.modalData.currency

      if (this.modalData.shipping_address) {
        this.shipping = this.modalData.shipping_address
        this.shippingCountry = this.modalData.shipping_address.country
      }
    },
    async submitCustomerData() {
      this.$v.formData.$touch()
      this.$v.shipping.$touch()
      if (this.$v.$invalid) {
        return true
      }

      // this.checkAddress()
      if (this.hasShippingAdd) {
        this.formData.addresses = [{ ...this.shipping }]
      }

      this.isLoading = true

      try {
        let response = null
        if (this.modalDataID) {
          response = await this.updateCustomer(this.formData)
        } else {
          response = await this.addCustomer(this.formData)
        }
        if (response.data) {
          if (this.modalDataID) {
            this.showNotification({
              type: 'success',
              message: this.$tc('customers.updated_message'),
            })
          } else {
            this.showNotification({
              type: 'success',
              message: this.$tc('customers.created_message'),
            })
          }

          this.isLoading = false
          if (
            this.$route.name === 'invoices.create' ||
            this.$route.name === 'invoices.edit'
          ) {
            this.setInvoiceCustomer(response.data.customer.id)
          }
          if (
            this.$route.name === 'estimates.create' ||
            this.$route.name === 'estimates.edit'
          ) {
            this.setEstimateCustomer(response.data.customer.id)
          }
          this.resetData()
          this.closeModal()
          return true
        }
      } catch (err) {
        this.isLoading = false
        // if (err.response.data.errors.email) {
        //   window.toastr['error'](this.$t('validation.email_already_taken'))
        // }
      }
    },
  },
}
</script>
