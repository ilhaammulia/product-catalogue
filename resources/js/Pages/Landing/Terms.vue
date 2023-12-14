<template>
  <AppLayout>

    <Head>
      <title>Term of Service</title>
    </Head>
    <section>
      <main id="content" role="main" class="max-w-60">
        <div class="md:max-w-screen-sm text-center px-4 sm:px-6 lg:px-8 pt-12 md:pt-24 pb-6 mx-auto">
          <h1 class="text-2xl font-bold md:text-4xl text-gold-600">Terms &amp; Conditions</h1>
        </div>

        <div class="md:max-w-screen-sm lg:max-w-[992px] px-4 sm:px-6 lg:px-8 pb-12 md:pt-6 sm:pb-20 mx-auto">
          <div class="grid gap-4 md:gap-8">
            <div>
              <h2 class="text-lg sm:text-xl font-semibold mb-2 text-gold-600">Acceptance and Use of Services</h2>

              <p class="mb-5 text-gray-400">Welcome to Coinluxe! By using our platform, you agree to abide by these Terms of Service. Your access and usage of Coinluxe signify your acceptance of these terms.</p>

              <p class="mb-5 text-gray-400">It's essential to comply with all regulations and laws applicable in your jurisdiction when using our services. If you do not agree with any part of these terms, refrain from accessing or using our platform.</p>
            </div>

            <div>
              <h2 class="text-lg sm:text-xl font-semibold mb-2 text-gold-600">Product Information and User Responsibility</h2>

              <p class="mb-5 text-gray-400">At Coinluxe, we strive to provide accurate and up-to-date information, but we can't guarantee that all content will be error-free or entirely current. Users are encouraged to cross-verify any information provided on our platform before making any significant decisions based on that material.</p>

              <p class="text-gray-400">It's important to note that our product availability may be limited, and certain products may have specific usage policies or restrictions. Additionally, any links to third-party sites provided on Coinluxe are for convenience, and users should be aware that these external links operate independently, and we hold no responsibility for their content or actions. We advise users to proceed with caution and understand the terms of those external websites before engaging with them.</p>
            </div>

            <div>
              <h2 class="text-lg sm:text-xl font-semibold mb-2 text-gold-600">Ordering and Usage Policies</h2>

              <p class="text-gray-400">Placing orders on Coinluxe is subject to product availability and may have quantity limitations. Accuracy in providing billing and account information is crucial. Users are responsible for ensuring the accuracy of their details to facilitate smooth transactions.</p>
            
              <p class="text-gray-400">It's important to understand that while we strive for accuracy in representing product images, actual colors may vary due to device displays. Moreover, links to third-party sites provided on Coinluxe are used at the user's discretion, and Coinluxe holds no liability for the outcomes or actions on these external sites.</p>
            </div>

            <div>
              <h2 class="text-lg sm:text-xl font-semibold mb-2 text-gold-600">User Conduct and Liability</h2>

              <p class="text-gray-400">Coinluxe requires users to adhere strictly to the Terms of Service and refrain from engaging in unlawful, abusive, or misleading activities on the platform. Users are solely responsible for their actions while using our services.</p>
            
              <p class="text-gray-400">Additionally, Coinluxe disclaims any liability for damages resulting from the use of our services, including but not limited to, errors, interruptions, or inaccuracies in content.</p>
            </div>

            <div>
              <h2 class="text-lg sm:text-xl font-semibold mb-2 text-gold-600">Legal Compliance and Dispute Resolution</h2>

              <p class="text-gray-400">Users engaging with Coinluxe must comply with all local laws and regulations governing their use of our services. In the event of any disputes, the governing laws and jurisdiction specified in these Terms of Service will apply.</p>

              <p class="text-gray-400">It's recommended to resolve any conflicts through direct communication. Should the need arise, mediation and arbitration processes are available for dispute resolution in accordance with the specified legal procedures and laws.</p>
            </div>
          </div>
        </div>
    </main>
  </section>
</AppLayout></template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3'

export default {
  components: {
    AppLayout,
    Head
  },
}
</script>
