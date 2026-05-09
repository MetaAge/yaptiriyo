import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/view_models/conversation_view_model/send_offer_view_model.dart';

import '../../../helper/local_keys.g.dart';

class SendOfferButtons extends StatelessWidget {
  final dynamic clientId;
  const SendOfferButtons({super.key, this.clientId});

  @override
  Widget build(BuildContext context) {
    final ov = Provider.of<SendOfferViewModel>(context);
    return Row(
      children: [
        Expanded(
          flex: 16,
          child: OutlinedButton(
            onPressed: () {
              Navigator.pop(context);
            },
            child: Text(LocalKeys.cancel),
          ),
        ),
        const Expanded(flex: 1, child: SizedBox()),
        Expanded(
          flex: 16,
          child: ValueListenableBuilder(
            valueListenable: ov.loading,
            builder: (context, loading, child) {
              return ElevatedButton(
                onPressed: loading ? null : () => ov.submitOffer(context, clientId: clientId),
                child: loading 
                  ? const SizedBox(height: 20, width: 20, child: CircularProgressIndicator(color: Colors.white, strokeWidth: 2))
                  : Text(LocalKeys.sendOffer),
              );
            }
          ),
        ),
      ],
    );
  }
}
